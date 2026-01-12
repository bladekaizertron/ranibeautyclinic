<?php
header('Content-Type: application/json');
include '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $client_id = $_GET['client_id'] ?? null;

    if (!$client_id) {
        echo json_encode(['status' => 'error', 'message' => 'Client ID is required']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM intake_submissions WHERE client_id = ? ORDER BY submitted_at DESC");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $forms = [];
    while ($row = $result->fetch_assoc()) {
        $forms[] = $row;
    }

    echo json_encode(['status' => 'success', 'data' => $forms]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
