<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../db_conn.php";

$staff_id = isset($_GET['staff_id']) ? mysqli_real_escape_string($conn, $_GET['staff_id']) : null;
$work_date = isset($_GET['work_date']) ? mysqli_real_escape_string($conn, $_GET['work_date']) : null;

if (!$staff_id || !$work_date) {
    echo json_encode(["status" => "error", "message" => "Missing staff_id or work_date"]);
    exit;
}

// 1. Get staff work hours for that date
$sql = "SELECT start_time, end_time FROM staff_schedules WHERE staff_id = '$staff_id' AND work_date = '$work_date'";
$result = mysqli_query($conn, $sql);

$slots = [];
while ($row = mysqli_fetch_assoc($result)) {
    $start = strtotime($row['start_time']);
    $end = strtotime($row['end_time']);
    
    // Generate 1-hour slots
    $current = $start;
    while ($current + (60 * 60) <= $end) {
        $slots[] = date("g:i A", $current);
        $current += (60 * 60); // 1 hour increments
    }
}

// In a real app, you'd also filter out existing appointments.
// For now, we just return slots based on work hours.

echo json_encode($slots);
?>
