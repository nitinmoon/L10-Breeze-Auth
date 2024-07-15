<?php

namespace App\Http\Controllers;

use App\Jobs\ProductEmailJob;
use App\Mail\ProductJobEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Jobs\ProductCSVDataJob;
use Illuminate\Support\Facades\Bus;

class ProductController extends Controller
{
    public function index() : View 
    {
        return view('product-job.productImport');
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv'
        ]);

        if ($request->has('csv_file')) {
           
            $csv = file($request->csv_file);
            $chunks = array_chunk($csv, 5);
            $header = [];
            $batch = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $value) {
                
                $data = array_map('str_getcsv', $value);

                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new ProductCSVDataJob($data, $header));
            }

            return redirect()->route('product.productImportJob')
                    ->with('success', 'CSV added on queue successfully!');
           
        }
        
    }


    public function sendProductJobQueue()
    {
        $users = User::get();
        #Path to the attachment (ensure this path is correct)
        $attachmentPath = public_path('dummy-pdf.pdf');
        #Loop through users and dispatch the job
        foreach ($users as $user) {
            ProductEmailJob::dispatch($user, $attachmentPath);
        }

        return back()->with('success', 'Emails are in queue will send soon.');
    }
}
