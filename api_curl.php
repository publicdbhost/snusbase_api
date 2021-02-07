<?php
// Official Snusbase sample code. This code is provided as-is and is only for refference of how to
// handle our API. For API access contact customer support through email, and briefly describe your
// use-case and we'll get back to you as soon as we can.

function search(array $postData, $url = "https://api.snusbase.com/v3/search", $token="YOUR_AUTHENTICATION_TOKEN_HERE", $timeout = "40") 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: '.$token));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, "Snusbase");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        $curl_info = curl_getinfo($ch);
    
        return compact('response', 'curl_info');
        if(curl_errno($ch))
        {
            echo 'Curl error: ' . curl_error($ch);
        }
    }

// Create the search query / array (feed your own data, eg $type = "email"; $term = "test@test.com", etc)
$postData = Array("type" => $type, "term" => $term, "wildcard" => $wildcard, "limit" => $limit, "offset" => $offset);

// Pass search query / array to search function, store response in $apiResponse
$apiResponse = search($postData);
?>
