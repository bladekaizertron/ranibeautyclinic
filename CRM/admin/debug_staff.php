<?php
include 'db_conn.php';
$res = $conn->query("SELECT * FROM staff");
while($row = $res->fetch_assoc()) {
    echo $row['id'] . " | " . $row['name'] . " | " . $row['role'] . "\n";
}
?>
