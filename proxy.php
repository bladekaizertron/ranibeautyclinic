<?php
// proxy.php

// 1. Enable CORS for your domain (allow requests from your website)
header("Access-Control-Allow-Origin: *"); // For production, change * to your specific domain
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 2. Handle Preflight Requests (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 3. Configuration - Set your API Key and Endpoint here
// PROD: https://api.boulevard.io/graphql
// SANDBOX: https://sandbox.joinblvd.com/graphql (or check Boulevard docs for exact sandbox graphql url)
// Based on user logs, we are targeting Sandbox.
// Note: If 'https://sandbox.joinblvd.com/graphql' fails, try 'https://api.boulevard.io/graphql'
$boulevardUrl = 'https://sandbox.joinblvd.com/graphql'; 
$apiKey = '90c28c66-092d-423e-bfaa-86e2a1d8ced2';

// 4. Get the JSON body sent from the frontend
$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, true);

if (!$inputData) {
    http_response_code(400);
    echo json_encode(['error' => 'No input provided']);
    exit();
}

// 5. Forward the request to Boulevard
$ch = curl_init($boulevardUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $inputJSON);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($apiKey . ':') // Documentation usually specifies Basic Auth with API Key as username
    // OR
    // 'Authorization: Bearer ' . $apiKey
]);

// Note: Boulevard API docs usually say "Basic Auth" using the API key as the username.
// But the frontend code was using "Bearer". The proxy will try "Basic" first as it's common for server-side keys.
// If your previous frontend code worked with Bearer, we can use that.
// Let's stick to what the frontend was trying: "Bearer"
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// 6. Return the response to the frontend
http_response_code($httpCode);
if ($curlError) {
    echo json_encode(['errors' => [['message' => 'Proxy cURL Error: ' . $curlError]]]);
} else {
    echo $response;
}
?>
