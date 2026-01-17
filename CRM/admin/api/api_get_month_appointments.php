<?php
include '../db_conn.php';
header('Content-Type: application/json');

// Set timezone to Renton, WA
date_default_timezone_set('America/Los_Angeles');

$month = isset($_GET['month']) ? intval($_GET['month']) + 1 : date('n'); // JS months are 0-indexed
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Calculate start and end dates for the query
$startDate = sprintf('%04d-%02d-01', $year, $month);
$endDate = date('Y-m-t', strtotime($startDate));

$sql = "SELECT appointment_date, COUNT(*) as count 
        FROM appointments 
        WHERE appointment_date BETWEEN '$startDate' AND '$endDate' 
        AND status != 'cancelled'
        GROUP BY appointment_date";

$result = mysqli_query($conn, $sql);
$appointments = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[$row['appointment_date']] = intval($row['count']);
    }
}

echo json_encode(['status' => 'success', 'data' => $appointments]);
?>
