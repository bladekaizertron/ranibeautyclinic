<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../db_conn.php";

$sql = "SELECT id, name, phone, email, created_at FROM clients ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if ($result) {
    $clients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }
    echo json_encode($clients);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to fetch clients: " . mysqli_error($conn)]);
}
?>
