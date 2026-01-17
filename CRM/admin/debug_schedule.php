<?php
include 'db_conn.php';

// Check what the server thinks 'now' is
date_default_timezone_set('America/Los_Angeles'); // Use the same timezone as the API
$serverDate = date('Y-m-d');
$serverTime = date('H:i:s');
echo "Server Timezone: " . date_default_timezone_get() . "\n";
echo "Server Date: " . $serverDate . "\n";
echo "Server Time: " . $serverTime . "\n\n";

echo "--- Schedule Dump for Today ($serverDate) ---\n";

$sql = "SELECT s.name, ss.* 
        FROM staff_schedules ss 
        JOIN staff s ON ss.staff_id = s.id 
        WHERE ss.work_date = '$serverDate'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Staff: " . $row['name'] . "\n";
        echo "Shift: " . $row['start_time'] . " - " . $row['end_time'] . "\n";
        
        // Debug logic
        $is_working = ($serverTime >= $row['start_time'] && $serverTime <= $row['end_time']);
        echo "Is Working Logic: ($serverTime >= " . $row['start_time'] . " && $serverTime <= " . $row['end_time'] . ") => " . ($is_working ? "TRUE" : "FALSE") . "\n";
        echo "----------------\n";
    }
} else {
    echo "No shifts found for today.";
}
?>
