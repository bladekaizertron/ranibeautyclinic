<?php
include '../db_conn.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $service_name = isset($_GET['service']) ? $_GET['service'] : null;
    $staff_name = isset($_GET['staff']) ? $_GET['staff'] : null;
    
    if ($service_name) {
        $sql = "SELECT s.name as staff_name, ss.is_available 
                FROM staff s 
                JOIN service_staff ss ON s.id = ss.staff_id 
                JOIN services ser ON ss.service_id = ser.id 
                WHERE ser.name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $service_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $availability = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($availability);
    } elseif ($staff_name) {
        $sql = "SELECT ser.name as service_name, ss.is_available 
                FROM services ser 
                JOIN service_staff ss ON ser.id = ss.service_id 
                JOIN staff s ON ss.staff_id = s.id 
                WHERE s.name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $staff_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $availability = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($availability);
    } else {
        // Fetch all availability for index.html
        $sql = "SELECT ser.name as service_name, s.name as staff_name, ss.is_available 
                FROM staff s 
                JOIN service_staff ss ON s.id = ss.staff_id 
                JOIN services ser ON ss.service_id = ser.id 
                WHERE ss.is_available = 1";
        $result = mysqli_query($conn, $sql);
        $availability = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($availability);
    }
} elseif ($method === 'POST') {
    // Save availability
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['service'])) {
        $service_name = $data['service'];
        $staff_availabilities = $data['staff']; // Array of {name: "Staff Name", available: true/false}

        // 1. Get or Create Service ID
        $stmt = mysqli_prepare($conn, "SELECT id FROM services WHERE name = ?");
        mysqli_stmt_bind_param($stmt, "s", $service_name);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $service = mysqli_fetch_assoc($res);
        
        if (!$service) {
            $stmt = mysqli_prepare($conn, "INSERT INTO services (name) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $service_name);
            mysqli_stmt_execute($stmt);
            $service_id = mysqli_insert_id($conn);
        } else {
            $service_id = $service['id'];
        }

        foreach ($staff_availabilities as $sa) {
            $staff_name = $sa['name'];
            $is_available = $sa['available'] ? 1 : 0;

            // 2. Get or Create Staff ID
            $stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE name = ?");
            mysqli_stmt_bind_param($stmt, "s", $staff_name);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $staff = mysqli_fetch_assoc($res);

            if (!$staff) {
                $stmt = mysqli_prepare($conn, "INSERT INTO staff (name) VALUES (?)");
                mysqli_stmt_bind_param($stmt, "s", $staff_name);
                mysqli_stmt_execute($stmt);
                $staff_id = mysqli_insert_id($conn);
            } else {
                $staff_id = $staff['id'];
            }

            // 3. Update or Insert availability
            $stmt = mysqli_prepare($conn, "INSERT INTO service_staff (service_id, staff_id, is_available) 
                                           VALUES (?, ?, ?) 
                                           ON DUPLICATE KEY UPDATE is_available = VALUES(is_available)");
            mysqli_stmt_bind_param($stmt, "iii", $service_id, $staff_id, $is_available);
            mysqli_stmt_execute($stmt);
        }
    } elseif (isset($data['staff'])) {
        $staff_name = $data['staff'];
        $service_availabilities = $data['services']; // Array of {name: "Service Name", available: true/false}

        // 1. Get or Create Staff ID
        $stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE name = ?");
        mysqli_stmt_bind_param($stmt, "s", $staff_name);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $staff = mysqli_fetch_assoc($res);
        
        if (!$staff) {
            $stmt = mysqli_prepare($conn, "INSERT INTO staff (name) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $staff_name);
            mysqli_stmt_execute($stmt);
            $staff_id = mysqli_insert_id($conn);
        } else {
            $staff_id = $staff['id'];
        }

        foreach ($service_availabilities as $sa) {
            $service_name = $sa['name'];
            $is_available = $sa['available'] ? 1 : 0;

            // 2. Get or Create Service ID
            $stmt = mysqli_prepare($conn, "SELECT id FROM services WHERE name = ?");
            mysqli_stmt_bind_param($stmt, "s", $service_name);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $service = mysqli_fetch_assoc($res);

            if (!$service) {
                $stmt = mysqli_prepare($conn, "INSERT INTO services (name) VALUES (?)");
                mysqli_stmt_bind_param($stmt, "s", $service_name);
                mysqli_stmt_execute($stmt);
                $service_id = mysqli_insert_id($conn);
            } else {
                $service_id = $service['id'];
            }

            // 3. Update or Insert availability
            $stmt = mysqli_prepare($conn, "INSERT INTO service_staff (service_id, staff_id, is_available) 
                                           VALUES (?, ?, ?) 
                                           ON DUPLICATE KEY UPDATE is_available = VALUES(is_available)");
            mysqli_stmt_bind_param($stmt, "iii", $service_id, $staff_id, $is_available);
            mysqli_stmt_execute($stmt);
        }
    }

    echo json_encode(['status' => 'success']);
}
?>
