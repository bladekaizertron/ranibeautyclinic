<?php
header("Content-Type: application/json");
include '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && isset($_POST['client_id'])) {
    $clientId = (int)$_POST['client_id'];
    $uploadDir = '../uploads/gallery/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
    if (in_array(strtolower($fileType), $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $dbPath = 'uploads/gallery/' . $fileName;
            $sql = "INSERT INTO client_gallery (client_id, image_path) VALUES ($clientId, '$dbPath')";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["status" => "success", "message" => "Image uploaded successfully", "path" => $dbPath]);
            } else {
                echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to move uploaded file"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid file format: " . $fileType]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
