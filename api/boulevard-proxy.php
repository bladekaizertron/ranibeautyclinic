<?php
/**
 * Boulevard API Proxy
 * 
 * This proxy handles Boulevard API authentication using HMAC-SHA256 signing
 * and forwards GraphQL requests from the frontend to Boulevard's API.
 */

header('Content-Type: application/json');

// Load configuration first
require_once __DIR__ . '/config.php';

// CORS headers for local development
if (ENVIRONMENT === 'development') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Handle preflight requests
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
}

/**
 * Generate Boulevard API authentication token
 * 
 * Using Public Client Access for guest bookings (no CLIENT_ID required)
 * 
 * @return string Base64-encoded HTTP Basic credentials
 */
function generateBoulevardAuthToken()
{
    $apiKey = BOULEVARD_API_KEY;

    // Public Client Access: Just API_KEY with colon
    // Format: base64_encode(API_KEY + ":")
    $httpBasicPayload = $apiKey . ':';
    $httpBasicCredentials = base64_encode($httpBasicPayload);

    return $httpBasicCredentials;
}

/**
 * Proxy GraphQL request to Boulevard API
 */
function proxyToBoulevard($query, $variables = [])
{
    $authToken = generateBoulevardAuthToken();
    $apiUrl = BOULEVARD_API_URL;

    // Prepare the GraphQL request
    $requestBody = json_encode([
        'query' => $query,
        'variables' => $variables
    ]);

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . $authToken
    ]);

    // Don't follow redirects - we want to see the 302
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    // Log request details for debugging
    if (ENVIRONMENT === 'development') {
        error_log('[Boulevard Proxy] API URL: ' . $apiUrl);
        error_log('[Boulevard Proxy] Auth Token (first 20 chars): ' . substr($authToken, 0, 20) . '...');
        error_log('[Boulevard Proxy] Request Body: ' . substr($requestBody, 0, 200));
    }

    // Execute request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    // Get redirect location if any
    $redirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);

    curl_close($ch);

    // Log response for debugging
    if (ENVIRONMENT === 'development') {
        error_log('[Boulevard Proxy] HTTP Code: ' . $httpCode);
        error_log('[Boulevard Proxy] Response: ' . substr($response, 0, 500));
        if ($redirectUrl) {
            error_log('[Boulevard Proxy] Redirect URL: ' . $redirectUrl);
        }
    }

    // Handle errors
    if ($curlError) {
        return [
            'success' => false,
            'error' => 'cURL error: ' . $curlError
        ];
    }

    if ($httpCode !== 200) {
        return [
            'success' => false,
            'error' => 'HTTP ' . $httpCode . ': ' . $response,
            'httpCode' => $httpCode
        ];
    }

    return [
        'success' => true,
        'data' => json_decode($response, true)
    ];
}

// Main request handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get request body
    $input = file_get_contents('php://input');
    $requestData = json_decode($input, true);

    if (!$requestData || !isset($requestData['query'])) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Invalid request: missing query parameter'
        ]);
        exit;
    }

    $query = $requestData['query'];
    $variables = $requestData['variables'] ?? [];

    // Log request for debugging (only in development)
    if (ENVIRONMENT === 'development') {
        error_log('[Boulevard Proxy] Request: ' . substr($query, 0, 100) . '...');
    }

    // Proxy to Boulevard
    $result = proxyToBoulevard($query, $variables);

    if (!$result['success']) {
        http_response_code(500);
        echo json_encode([
            'error' => $result['error'],
            'httpCode' => $result['httpCode'] ?? null
        ]);
        exit;
    }

    // Return Boulevard's response
    echo json_encode($result['data']);

} else {
    http_response_code(405);
    echo json_encode([
        'error' => 'Method not allowed. Use POST.'
    ]);
}
