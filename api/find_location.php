<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

// Helper to make request
function queryBoulevard($query) {
    $url = BOULEVARD_API_URL;
    $key = BOULEVARD_API_KEY;
    
    $auth = base64_encode($key . ':');
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . $auth
    ]);
    
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    return json_decode($response, true);
}

echo "<h1>Looking up locations...</h1>";

// Try Root Locations Query
$query = <<<GQL
query {
    locations(first: 10) {
        edges {
            node {
                id
                name
                tz
            }
        }
    }
}
GQL;

$result = queryBoulevard($query);

echo "<pre>";
print_r($result);
echo "</pre>";

if (isset($result['data']['locations']['edges'])) {
    echo "<h2>Found Locations:</h2>";
    echo "<ul>";
    foreach ($result['data']['locations']['edges'] as $edge) {
        $loc = $edge['node'];
        echo "<li><strong>" . htmlspecialchars($loc['name']) . "</strong><br>";
        echo "ID: <code>" . htmlspecialchars($loc['id']) . "</code><br>";
        echo "Timezone: " . htmlspecialchars($loc['tz']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h2 style='color:red'>No locations found or error occurred.</h2>";
}
?>
