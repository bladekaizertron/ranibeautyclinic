<?php
header("Content-Type: application/json");
include '../db_conn.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['image_id']) && isset($data['image_path'])) {
    $imageId = (int)$data['image_id'];
    $imagePath = $data['image_path']; // e.g., "uploads/gallery/123.jpg"

    // Sanitize path to prevent directory traversal
    $imagePath = basename($imagePath);
    $fullPath = '../uploads/gallery/' . $imagePath;

    // Delete record from database
    $sql = "DELETE FROM client_gallery WHERE id = $imageId";
    
    if ($conn->query($sql) === TRUE) {
        // Delete file from filesystem
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        echo json_encode(["status" => "success", "message" => "Image deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
