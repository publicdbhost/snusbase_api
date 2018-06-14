<?php
// Official Snusbase sample code. This code is provided as-is and is only for refference of how to
// properly handle our API. For API access contact us through one of our support channels, and we
// can make a deal depending on your usage case. API packages start at $80/month.

function search(array $postData, $url = "http://business.snusbase.com", $token, $timeout = "40") 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
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

// Creates array from post form
$postData = Array("type" => $post_type, "term" => $post_term, "wildcard" => $wildcard, "limit" => $limit, "offset" => $offset);

// Passes array to function
$apiResponse = search($postData, "http://business.snusbase.com?names", "sbactivationcodexd", 40);;
?>
