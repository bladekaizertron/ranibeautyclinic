<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../db_conn.php";

if (!isset($_GET['client_id'])) {
    echo json_encode(["status" => "error", "message" => "Missing client_id"]);
    exit;
}

$client_id = (int)$_GET['client_id'];

$sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.services, a.total_price, a.created_at, 
               s.name as staff_name
        FROM appointments a 
        JOIN staff s ON a.staff_id = s.id
        WHERE a.client_id = $client_id AND a.status = 'confirmed'
        ORDER BY a.appointment_date ASC, a.appointment_time ASC";

$result = mysqli_query($conn, $sql);

if ($result) {
    $appointments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
    echo json_encode($appointments);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to fetch appointments: " . mysqli_error($conn)]);
}
?>
