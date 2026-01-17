<?php
include '../db_conn.php';
header('Content-Type: application/json');

$staff_name = isset($_GET['staff_name']) ? $_GET['staff_name'] : '';

if (empty($staff_name)) {
    echo json_encode(['status' => 'error', 'message' => 'Staff name is required']);
    exit;
}

// 1. Get Staff ID from Name
$stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE name = ?");
mysqli_stmt_bind_param($stmt, "s", $staff_name);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$staff = mysqli_fetch_assoc($res);

if (!$staff) {
    echo json_encode(['status' => 'error', 'message' => 'Staff not found']);
    exit;
}

$staff_id = $staff['id'];

// 2. Fetch Appointments
$sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.status, a.services, a.total_price,
               c.name as client_name, c.phone as client_phone
        FROM appointments a
        JOIN clients c ON a.client_id = c.id
        WHERE a.staff_id = ?
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $staff_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $appointments]);
?>
