<?php

namespace App\Services;


use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use App\Models\PhonepeTransaction;
use Illuminate\Support\Facades\Session;

class PhonePeService
{

    protected $phonepeTransaction;
   

    protected $client;
    protected $merchantId;
    protected $merchantKey;
    protected $saltIndex;
    protected $baseUrl;
    protected $statusUrl;

    public function __construct(PhonepeTransaction $phonepeTransaction)
    {
        $this->merchantId = config('phonepe.merchant_id');
        $this->merchantKey = config('phonepe.merchant_key');
        $this->saltIndex = config('phonepe.salt_index');
        $this->baseUrl = config('phonepe.base_url');
        $this->statusUrl = config('phonepe.status_url');

        $this->phonepeTransaction = $phonepeTransaction; #For calling model function
    }
   
    public function initiatePayment($amount)
    {
        $data = [
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => "MTI-".uniqid(),
            'user_id' => auth()->user()->id,
            'merchantUserId' => 'MUID123',
            'amount' => $amount * 100, // Convert to paisa
            'redirectUrl' => route('phonepe.callback'),  #Not used
            'redirectMode' => 'POST',
            'callbackUrl' => route('phonepe.callback'),
            'mobileNumber' => '9999999999',
            "order_id" => 'Test-Order-Id',
            "merchantOrderId" => "MOI".uniqid(),
            'paymentInstrument' => 
            [
                'type' => 'PAY_PAGE',
            ],
        ];

        #Store first transaction into our database start
        $storeData = [
            'user_id' => $data['user_id'],  #We can add as per our choise
            'merchant_user_id' =>  $data['merchantUserId'],
            'merchant_transaction_id' =>  $data['merchantTransactionId'],
            'order_id' =>  $data['order_id'],
            'amount' =>  $amount,
            'customer_mobile' =>  $data['mobileNumber'],
            'payment_done' =>  'No',
        ];
       
        $saveDataId = $this->phonepeTransaction->storeTransaction($storeData);
        #Store session data because in callback it will need to update
        Session::put('phonePePrimaryKey', $saveDataId);
        #Store first transaction into our database start
    
        $encode = base64_encode(json_encode($data));
 
        $string = $encode.'/pg/v1/pay'.$this->merchantKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'. $this->saltIndex;
         
        try {

            $response = Curl::to($this->baseUrl)
                ->withHeader('Content-Type:application/json')
                ->withHeader('X-VERIFY:'.$finalXHeader)
                ->withData(json_encode(['request' => $encode]))
                ->post();
           
                $initiate = json_decode($response, true);

                #Update the transaction table
                $updateData = [
                    'code' => $initiate['code'], 
                    'message' => $initiate['message'],
                    'response_data' => json_encode($initiate)
                ];
                $this->phonepeTransaction->updateTransaction($updateData);
             
 
            return $initiate;

        } catch (\Exception $e) {
            
            Log::error('PhonePe Payment Error: ' . $e->getMessage());
            #Update the transaction table
            $updateData = [
                'code' => 'PAYMENT_ERROR',
                'message' => 'PhonePe Payment Error: ' . $e->getMessage()
            ];
            $this->phonepeTransaction->updateTransaction($updateData);

            return  $e->getMessage();
        }
    }


    public function callbackResponse($input)
    {
        try {
            $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$this->merchantKey).'###'.$this->saltIndex;

            $response = Curl::to($this->statusUrl.$input['merchantId'].'/'.$input['transactionId'])
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('accept:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
                    ->get();
                    
            $initiate = json_decode($response, true);
         
            #Update the transaction table
            $updateData = [
                'transaction_id' => $initiate['data']['transactionId'], 
                'payment_done' =>  'Yes',
                'code' => $initiate['code'], 
                'message' => $initiate['message'],
                'payment_method' => $initiate['data']['paymentInstrument']['type'],
                'response_data' => json_encode($initiate)
            ];
           

            $this->phonepeTransaction->updateTransaction($updateData);
    
            return $initiate;

        } catch (\Exception $e) {
            Log::error('PhonePe Payment Error: ' . $e->getMessage());

            #Update the transaction table
            $updateData = [
                'code' => 'PAYMENT_ERROR',
                'message' => 'PhonePe Payment Error: ' . $e->getMessage()
            ];

            return  $e->getMessage();
        }
    }


    #Need to look into this function because its not showing the PAYMENT_PENDING status in the payload of first refund call
    public function phonePeRefundProcess($merchantTransactionId)
    {
        $payload = [
            'merchantId' => $this->merchantId,
            'merchantUserId' => 'MUID123',
            'merchantTransactionId' => $merchantTransactionId,
            'originalTransactionId' => strrev($merchantTransactionId),
            'amount' => 3 * 100, // Convert to paisa,
            'callbackUrl' => route('phonepe.callback.refund'),
        ];
 
       
        $encode = base64_encode(json_encode($payload));
 
        $string = $encode.'/pg/v1/refund'.$this->merchantKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'. $this->saltIndex;
 
        $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/refund')
                 ->withHeader('Content-Type:application/json')
                 ->withHeader('X-VERIFY:'.$finalXHeader)
                 ->withData(json_encode(['request' => $encode]))
                 ->post();
 
        $rData = json_decode($response, true);
 
        
       
 
        $finalXHeader1 = hash('sha256','/pg/v1/status/'.$this->merchantId.'/'.$merchantTransactionId.$this->merchantKey).'###'.$this->saltIndex;
 
        $responsestatus = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$this->merchantId.'/'.$merchantTransactionId)
                 ->withHeader('Content-Type:application/json')
                 ->withHeader('accept:application/json')
                 ->withHeader('X-VERIFY:'.$finalXHeader1)
                 ->withHeader('X-MERCHANT-ID:'.$merchantTransactionId)
                 ->get();
        return json_decode($responsestatus, true);
         //dd(json_decode($response),json_decode($responsestatus));
    }
}