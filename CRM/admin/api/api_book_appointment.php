<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../db_conn.php";

// Self-healing: Ensure appointments table exists
$check_table = "CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    staff_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('unconfirmed', 'confirmed', 'completed', 'cancelled') DEFAULT 'unconfirmed',
    services TEXT,
    total_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
)";
mysqli_query($conn, $check_table);

$data = json_decode(file_get_contents("php://input"), true);

$required_fields = ['name', 'phone', 'email', 'staff_id', 'date', 'time', 'services', 'total_price'];
$missing_fields = [];
foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        $missing_fields[] = $field;
    }
}

if (empty($missing_fields)) {
    
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $name = mysqli_real_escape_string($conn, validate($data['name']));
    $phone = mysqli_real_escape_string($conn, validate($data['phone']));
    $email = mysqli_real_escape_string($conn, validate($data['email']));
    $staff_id = (int)$data['staff_id'];
    $date = mysqli_real_escape_string($conn, validate($data['date']));
    $time_raw = validate($data['time']);
    
    $timestamp = strtotime($time_raw);
    if ($timestamp === false) {
        echo json_encode(["status" => "error", "message" => "Invalid time format received: '$time_raw'"]);
        exit();
    }
    $time = date("H:i:s", $timestamp);
    $time = mysqli_real_escape_string($conn, $time);
    
    $services = mysqli_real_escape_string($conn, validate($data['services']));
    $total_price = (float)$data['total_price'];

    if (empty($name) || empty($phone) || empty($email) || empty($date) || empty($time) || $staff_id <= 0) {
        $msg = "Required fields are missing or invalid.";
        if ($staff_id <= 0) $msg .= " Invalid Staff ID ($staff_id).";
        if (empty($time)) $msg .= " Missing Time.";
        echo json_encode(["status" => "error", "message" => $msg]);
        exit();
    }

    // 1. Check if client exists, or create new
    $client_id = 0;
    $check_client = "SELECT id FROM clients WHERE email = '$email' OR phone = '$phone' LIMIT 1";
    $res_client = mysqli_query($conn, $check_client);
    
    if ($res_client && mysqli_num_rows($res_client) > 0) {
        $row = mysqli_fetch_assoc($res_client);
        $client_id = $row['id'];
    } else {
        $ins_client = "INSERT INTO clients(name, phone, email) VALUES('$name', '$phone', '$email')";
        if (mysqli_query($conn, $ins_client)) {
            $client_id = mysqli_insert_id($conn);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to create client: " . mysqli_error($conn)]);
            exit();
        }
    }

    // 2. Prevent exact duplicate appointments (same client, same time, same date) 
    // within a short window to handle double-clicks
    $check_dup = "SELECT id FROM appointments 
                  WHERE client_id = '$client_id' 
                  AND appointment_date = '$date' 
                  AND appointment_time = '$time' 
                  AND created_at > DATE_SUB(NOW(), INTERVAL 5 MINUTE) 
                  LIMIT 1";
    $res_dup = mysqli_query($conn, $check_dup);
    if ($res_dup && mysqli_num_rows($res_dup) > 0) {
        $row = mysqli_fetch_assoc($res_dup);
        echo json_encode(["status" => "success", "message" => "Appointment already recorded", "appointment_id" => $row['id']]);
        exit();
    }

    // 3. Create appointment
    $sql = "INSERT INTO appointments(client_id, staff_id, appointment_date, appointment_time, services, total_price, status) 
            VALUES('$client_id', '$staff_id', '$date', '$time', '$services', '$total_price', 'unconfirmed')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Appointment booked successfully", "appointment_id" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to book appointment. Database error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request data. Missing: " . implode(', ', $missing_fields)]);
}
?>
