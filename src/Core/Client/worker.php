<?php
    $file_pointer = __DIR__.'/.access_token';
    // sleep for the initial expiry response time
    $initial_delta = max(60, (int)$argv[4] - 60);
    if ($initial_delta > 0) {
        sleep($initial_delta);
    }
    while(true) {
        $file_content = file_get_contents($file_pointer);
        $lms_oauth2_endpoint = 'https://cloud.lucidworks.com/oauth2/default/'.$argv[3].'/v1/token';
        $curl_req = curl_init($lms_oauth2_endpoint);
        $customHeaders = array(
            'Accept-Encoding: gzip, deflate',
            'accept: application/json',
            'Authorization: Basic '.base64_encode($argv[1].':'.$argv[2]),
            'Content-Type: application/x-www-form-urlencoded',
            'cache-control: no-cache,no-cache',
        );
        curl_setopt($curl_req, CURLOPT_POST, true);
        curl_setopt($curl_req, CURLOPT_POSTFIELDS, "grant_type=client_credentials&scope=com.lucidworks.cloud.search.solr.customer");
        curl_setopt($curl_req, CURLOPT_HTTPHEADER, $customHeaders);

        curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, true);
        $lms_oauth2_response = curl_exec($curl_req);
        $res = json_decode($lms_oauth2_response, true);
        $token = $res['token_type'].' '.$res['access_token'];
        file_put_contents($file_pointer, $token);
        $delta = max(60, $res["expires_in"] - 60);
        sleep($delta);
    }
?>
