<?php
header("Content-Type: application/json");
include '../db_conn.php';

if (isset($_GET['client_id'])) {
    $clientId = (int)$_GET['client_id'];
    
    $sql = "SELECT * FROM client_gallery WHERE client_id = $clientId ORDER BY uploaded_at DESC";
    $result = $conn->query($sql);
    
    $images = array();
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
    }
    
    if ($result) {
        echo json_encode(["status" => "success", "images" => $images]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Client ID missing"]);
}

$conn->close();
?>
