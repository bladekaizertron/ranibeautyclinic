<?php
header('Content-Type: application/json');
ob_start();
include "../db_conn.php";
$conn_output = ob_get_clean();

if (!$conn) {
    // If connection failed, but we want to fail gracefully for the JSON API
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

$start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
$end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-t');

// Sanitize inputs
$start = mysqli_real_escape_string($conn, $start);
$end = mysqli_real_escape_string($conn, $end);

$sql = "SELECT a.*, c.name as client_name, c.phone as client_phone, s.name as staff_name, s.avatar_color
        FROM appointments a
        JOIN clients c ON a.client_id = c.id
        JOIN staff s ON a.staff_id = s.id
        WHERE a.appointment_date BETWEEN '$start' AND '$end'
        ORDER BY a.appointment_date ASC, a.appointment_time ASC";

$result = mysqli_query($conn, $sql);
$appointments = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
}

echo json_encode(['status' => 'success', 'data' => $appointments]);
?>
