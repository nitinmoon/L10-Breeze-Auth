<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Str;

class GoogleDriveController extends Controller
{

    public $gClient;

    
    public function index() : View 
    {
        return view('google-drive.form');
    }


    public function token()
    {
        $client_id = config('googledrive.client_id');
        $client_secret = config('googledrive.client_secret');
        $refresh_token = config('googledrive.refresh_token');
        #$folder_id = config('googledrive.folder_id');

        $response = Http::post('https://oauth2.googleapis.com/token', [

            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',

        ]);
         
        $accessToken = json_decode((string) $response->getBody(), true)['access_token'];

        return $accessToken;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'myfile' => 'required',
        ],
        [
            'myfile.required' => 'You have to choose the file!',
        ]);

        #Get access token
        $accessToken = $this->token();

        // Retrieve the file from the request
        $file = $request->file('myfile');
        $path = $file->getPathname();
        $name = $file->getClientOriginalName();
        $mime = $file->getClientMimeType();

         

         // Google Drive API URL for resumable upload
//          $url = 'https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable';

//          // Initialize the upload session
//          $initResponse = Http::withToken($accessToken)
          
//              ->post($url, [
//                  'name' => $name,
//                  'mimeType' => $mime,
//                  'parents' => [config('googledrive.folder_id')],
//              ]);
 
//          if ($initResponse->failed()) {
//              return response()->json(['error' => 'Failed to initialize upload'], $initResponse->status());
//          }
 
//          // Extract the upload URL from the response
//          $uploadUrl = $initResponse->header('Location');
//  dd($initResponse);
        //  // Upload the file content
        //  $uploadResponse = Http::withToken($accessToken)
        //      ->withHeaders([
        //          'Content-Length' => filesize($path),
        //         // 'Content-Type' => $mime,
        //      ])->attach('data', file_get_contents($path), $name)
        //      ->put($uploadUrl, []);
 
        //  if ($uploadResponse->failed()) {
        //      return response()->json(['error' => 'Failed to upload file'], $uploadResponse->status());
        //  }
 
        //  // Get the uploaded file ID
        //  $fileId = $uploadResponse->json()['id'];
 
        //  return response()->json(['file_id' => $fileId]);
        
        
    //     $name = Str::slug($request->myfile->getClientOriginalName());
    //      $mime = $request->myfile->getClientMimeType();
    //    $path=$request->myfile->getRealPath();
        
        $response=Http::withToken($accessToken)
        ->attach('data',file_get_contents($path),$name)
      
        ->post('https://www.googleapis.com/upload/drive/v3/files',
            [
                'data'=>$name,
                'Content-Type'=> $mime,
                'uploadType' => 'resumable',
              //  'parents' => [config('googledrive.folder_id')]
            ] 
                
             
            );

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer '.$accessToken,
        //     'Content-Type' => 'Application/json'
        // ])->post('https://www.googleapis.com/upload/drive/v3/files',[
        //     'data' => $name,
        //     'mimeType' => $mime,
        //     'uploadType' => 'resumable',
        //     'parents' => [config('googledrive.folder_id')]
        // ]);

        dd($response);
 
    }

  
}
