<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhonePeService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PhonePeController extends Controller
{
    protected $phonePeService;

    public function __construct(PhonePeService $phonePeService)
    {
        $this->phonePeService = $phonePeService;
    }

    public function index() : View
    {
       return view('phonepe.phonepe-form');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|between:1,100'
        ]);

        $amount = $request->input('amount');
 
        $response = $this->phonePeService->initiatePayment($amount);
         
        if ($response && $response['success']) {
             
            return redirect($response['data']['instrumentResponse']['redirectInfo']['url']);

        } else {
            return back()->with('error', 'Payment initiation failed.');
        }
    }

    public function handleCallback(Request $request)
    {
        $input = $request->all();
        $response = $this->phonePeService->callbackResponse($input);
       
        if (isset($response) && $response['code'] == 'PAYMENT_SUCCESS') {
            return redirect()->route('phonepe.form')->with('success', 'Payment successfully completed.');
        } else {
            return redirect()->route('phonepe.form')->with('error', 'Payment Failed.');
        } 


    }

    public function phonePeRefund($merchantTransactionId)
    {
        $response = $this->phonePeService->phonePeRefundProcess($merchantTransactionId);
        dd($response);
          
    }
   
    public function handleRefundCallback(Request $request)
    {
        dd($request->all());
    }
}
