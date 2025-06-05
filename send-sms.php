<?php


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.mista.io/sms',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('to' => "+250789590910", 'from' => 'School bus', 'unicode' => '0', 'sms' => "Hello abayo ! You child taped a card  the bus now on ", 'action' => 'send-sms'),
    CURLOPT_HTTPHEADER => array(
        'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
