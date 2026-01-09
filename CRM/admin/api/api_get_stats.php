<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../db_conn.php";

// Self-healing: Ensure appointments table exists
$check_table = "CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    staff_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('unconfirmed', 'confirmed', 'arrived', 'cancelled') DEFAULT 'unconfirmed',
    services TEXT,
    total_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
)";
mysqli_query($conn, $check_table);

$sql = "SELECT status, COUNT(*) as count FROM appointments GROUP BY status";
$result = mysqli_query($conn, $sql);

$stats = [
    'unconfirmed' => 0,
    'confirmed' => 0,
    'arrived' => 0,
    'cancelled' => 0,
    'unconfirmed_list' => [],
    'confirmed_list' => [],
    'arrived_list' => []
];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stats[$row['status']] = (int)$row['count'];
    }
}

// Helper to fetch list by status
function fetchList($conn, $status) {
    $rows = [];
    $sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.services, a.total_price, a.created_at, 
                   c.name as client_name, c.phone as client_phone,
                   s.name as staff_name
            FROM appointments a 
            JOIN clients c ON a.client_id = c.id 
            JOIN staff s ON a.staff_id = s.id
            WHERE a.status = '$status' 
            ORDER BY a.appointment_date ASC, a.appointment_time ASC";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

$stats['unconfirmed_list'] = fetchList($conn, 'unconfirmed');
$stats['confirmed_list'] = fetchList($conn, 'confirmed');
$stats['arrived_list'] = fetchList($conn, 'arrived');

echo json_encode($stats);
?>
