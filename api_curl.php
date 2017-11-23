<?php
// Official Snusbase sample code. This code is provided as-is and is only for refference of how to
// properly handle our API. For API access contact us through one of our support channels, and we
// can make a deal depending on your usage case. API packages start at $80/month.

function apiRequest(array $postData) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://yourapi.example.com"); // Replace with your endpoint
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: YourTokenHere')); // Replace this with your auth token
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
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
$postArray = Array("type" => $post_type, "term" => $post_term, "wildcard" => $wildcard, "limit" => $limit, "offset" => $offset);

// Passes array to function
$apiResponse = apiRequest($postArray);
?>
