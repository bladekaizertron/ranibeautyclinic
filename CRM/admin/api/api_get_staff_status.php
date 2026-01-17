<?php
include '../db_conn.php';
header('Content-Type: application/json');

// Set timezone to avoid server time mismatches (adjust as per user location if needed, defaulting to Pacific as seen in other files)
// Set timezone to Renton, WA (Pacific Time)
date_default_timezone_set('America/Los_Angeles');

$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

$sql = "SELECT s.id, s.name, s.role, s.avatar_color,
        (SELECT COUNT(*) FROM staff_schedules ss 
         WHERE ss.staff_id = s.id 
         AND ss.work_date = '$currentDate'
         AND '$currentTime' BETWEEN ss.start_time AND ss.end_time
        ) as is_working
        FROM staff s";

$result = mysqli_query($conn, $sql);
$staffList = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine status string
        $status = ($row['is_working'] > 0) ? 'Available' : 'Off Shift';
        
        $staffList[] = [
            'name' => $row['name'],
            'role' => $row['role'] ?? 'Staff',
            'status' => $status,
            'avatar_color' => $row['avatar_color'] ?? '#ccc'
        ];
    }
}

echo json_encode($staffList);
?>
