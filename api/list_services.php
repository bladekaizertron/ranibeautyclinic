<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

function queryBoulevard($query, $variables = []) {
    $url = BOULEVARD_API_URL;
    $key = BOULEVARD_API_KEY;
    $auth = base64_encode($key . ':');
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query, 'variables' => $variables]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . $auth
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

echo "<h1>List of Available Services</h1>";

// 1. Get Location ID first (to be safe, similar to index.html logic)
$locQuery = "query { locations(first: 5) { edges { node { id name } } } }";
$locData = queryBoulevard($locQuery);
$locationId = $locData['data']['locations']['edges'][0]['node']['id'] ?? null;
$locationName = $locData['data']['locations']['edges'][0]['node']['name'] ?? 'Unknown';

if (!$locationId) {
    die("<h2 style='color:red'>Could not find any location!</h2>");
}

echo "<h3>Location: " . htmlspecialchars($locationName) . " (" . htmlspecialchars($locationId) . ")</h3>";

// 2. Fetch categories and items for this location
$query = <<<GQL
query(\$id: ID!) {
    location(id: \$id) {
        serviceCategories(first: 100) {
            edges {
                node {
                    name
                    services(first: 100) {
                        edges {
                            node {
                                id
                                name
                                description
                            }
                        }
                    }
                }
            }
        }
    }
}
GQL;

$result = queryBoulevard($query, ['id' => $locationId]);

if (isset($result['data']['location']['serviceCategories']['edges'])) {
    echo "<ul>";
    foreach ($result['data']['location']['serviceCategories']['edges'] as $catEdge) {
        $category = $catEdge['node'];
        echo "<li><h4 style='margin-bottom:5px'>" . htmlspecialchars($category['name']) . "</h4><ul>";
        
        foreach ($category['services']['edges'] as $servEdge) {
            $service = $servEdge['node'];
            echo "<li>";
            echo "<strong>" . htmlspecialchars($service['name']) . "</strong><br>";
            echo "ID: <code>" . htmlspecialchars($service['id']) . "</code>";
            echo "</li>";
        }
        echo "</ul></li>";
    }
    echo "</ul>";
} else {
    echo "<pre>" . print_r($result, true) . "</pre>";
}
?>
