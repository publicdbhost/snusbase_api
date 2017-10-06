<?php
function apiRequest(array $postData) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://yourapi.example.com"); // Replace with your endpoint
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: YourTokenHere')); // Replace this with your auth token
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 40); // may want to reduce this
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
$postArray = Array("type" => $post_type, "term" => $post_term, "wildcard" => $wildcard, "limit" => $limit);

// Passes array to function
$response = apiRequest($postArray);
?>
