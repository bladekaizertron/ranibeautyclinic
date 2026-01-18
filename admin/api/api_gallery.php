<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
session_start();

// Enable CORS if needed (optional but good for debugging)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Security: Check Login
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$dataFile = __DIR__ . '/../data/gallery.json';
$uploadDir = __DIR__ . '/../../assets/images/gallery/';

// Ensure directories
if (!file_exists(dirname($dataFile))) {
    @mkdir(dirname($dataFile), 0777, true);
}
if (!file_exists($uploadDir)) {
    @mkdir($uploadDir, 0777, true);
}

// Handle GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($dataFile)) {
        echo file_get_contents($dataFile);
    } else {
        echo json_encode(['pageContent' => {}, 'galleryItems' => []]);
    }
    exit();
}

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    // RAW JSON REQUEST (for saving data)
    if (strpos($contentType, 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';

        if ($action === 'update_data') {
            $data = $input['data'] ?? null;
            if (!$data) {
                echo json_encode(['error' => 'No data provided']);
                exit();
            }

            // Save to file
            if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT))) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Failed to save data. Check permissions.']);
            }
            exit();
        }
    }
    // FORM REQUEST (for image upload)
    else {
        $action = $_POST['action'] ?? '';

        if ($action === 'upload_image') {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['error' => 'Image upload failed']);
                exit();
            }

            $file = $_FILES['image'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (!in_array($ext, $allowed)) {
                echo json_encode(['error' => 'Invalid file type']);
                exit();
            }

            $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $ext;
            $targetPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $relativePath = 'assets/images/gallery/' . $filename;
                echo json_encode(['success' => true, 'path' => $relativePath]);
            } else {
                echo json_encode(['error' => 'Failed to move uploaded file']);
            }
            exit();
        }
    }

    echo json_encode(['error' => 'Invalid action or request format']);
    exit();
}
?>
