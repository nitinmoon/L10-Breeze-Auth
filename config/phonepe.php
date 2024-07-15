<?php

return [
    'merchant_id' => 'PGTESTPAYUAT86',
    'merchant_key' => '96434309-7796-489d-8924-ab56988a6076',   #Or salt key
    'salt_index' => 1,
    'environment' => env('PHONEPE_ENVIRONMENT', 'sandbox'), // or 'production'
    'base_url' =>  'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay',
    'status_url' =>'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/', 
    //'base_url' => 'https://api.phonepe.com/apis/hermes/pg/v1/pay',
];