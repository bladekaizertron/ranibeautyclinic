<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

include "../db_conn.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $staff_id = isset($_GET['staff_id']) ? mysqli_real_escape_string($conn, $_GET['staff_id']) : null;
    $start_date = isset($_GET['start_date']) ? mysqli_real_escape_string($conn, $_GET['start_date']) : null;
    $end_date = isset($_GET['end_date']) ? mysqli_real_escape_string($conn, $_GET['end_date']) : null;

    $sql = "SELECT s.*, st.name as staff_name FROM staff_schedules s JOIN staff st ON s.staff_id = st.id WHERE 1=1";
    
    if ($staff_id) {
        $sql .= " AND s.staff_id = '$staff_id'";
    }
    if ($start_date) {
        $sql .= " AND s.work_date >= '$start_date'";
    }
    if ($end_date) {
        $sql .= " AND s.work_date <= '$end_date'";
    }

    $result = mysqli_query($conn, $sql);
    $schedules = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $schedules[] = $row;
    }
    echo json_encode($schedules);

} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['staff_id'], $data['work_date'], $data['start_time'], $data['end_time'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }

    $staff_id = mysqli_real_escape_string($conn, $data['staff_id']);
    $work_date = mysqli_real_escape_string($conn, $data['work_date']);
    $start_time = mysqli_real_escape_string($conn, $data['start_time']);
    $end_time = mysqli_real_escape_string($conn, $data['end_time']);

    $sql = "INSERT INTO staff_schedules (staff_id, work_date, start_time, end_time) VALUES ('$staff_id', '$work_date', '$start_time', '$end_time')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "id" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }

} elseif ($method === 'DELETE') {
    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;
    if (!$id) {
        echo json_encode(["status" => "error", "message" => "Missing ID"]);
        exit;
    }

    $sql = "DELETE FROM staff_schedules WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
}
?>
