<?php
// proxy.php

// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Added GET for testing
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 2. Handle Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 3. Simple Test Endpoint (GET request)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(["status" => "Proxy is working", "message" => "Send a POST request with GraphQL query."]);
    exit();
}

// 4. Configuration
// User reported 404 on joinblvd.com. Switching to standard API endpoint.
// Even for sandbox keys, often the main endpoint is used.
$boulevardUrl = 'https://api.boulevard.io/graphql'; 
// If that fails, we can try: 'https://dashboard.boulevard.io/api/2020-01/graphql'
$apiKey = '90c28c66-092d-423e-bfaa-86e2a1d8ced2';

// 5. Get Input
$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, true);

if (!$inputData && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // If input is empty, maybe it's just a connection check?
    // Let's log it
    http_response_code(400); 
    echo json_encode(['error' => 'No JSON input received', 'raw_input' => $inputJSON]);
    exit();
}

// 6. Forward to Boulevard
$ch = curl_init($boulevardUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $inputJSON);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($apiKey . ':')
]);
// Timeout to prevent hanging
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// 7. Output Result
http_response_code($httpCode ? $httpCode : 500); // Default to 500 if curl failed

if ($curlError) {
    echo json_encode([
        'errors' => [[
            'message' => 'Proxy cURL Error: ' . $curlError,
            'endpoint' => $boulevardUrl
        ]]
    ]);
} else {
    // Check if the response itself is an error html page (common with 404/500 from upstream)
    if (strpos($response, '<!DOCTYPE html>') !== false) {
        // Upstream returned HTML instead of JSON
        echo json_encode([
            'errors' => [[
                'message' => 'Upstream API returned HTML instead of JSON. Endpoint might be wrong.',
                'endpoint' => $boulevardUrl,
                'preview' => substr(strip_tags($response), 0, 100)
            ]]
        ]);
    } else {
        echo $response;
    }
}
?>
