<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../db_conn.php";

$data = json_decode(file_get_contents("php://input"), true);

// Validation function
function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// Check required fields
if (!isset($data['name']) || !isset($data['phone']) || !isset($data['email'])) {
    echo json_encode(["status" => "error", "message" => "Name, phone, and email are required"]);
    exit();
}

// Validate and sanitize required fields
$name = validate($data['name']);
$phone = validate($data['phone']);
$email = validate($data['email']);

// Validate optional fields
$address = isset($data['address']) ? validate($data['address']) : null;
$birthday = isset($data['birthday']) && !empty($data['birthday']) ? validate($data['birthday']) : null;
$gender = isset($data['gender']) ? validate($data['gender']) : null;
$notes = isset($data['notes']) ? validate($data['notes']) : null;
$membership_status = isset($data['membership_status']) ? validate($data['membership_status']) : 'regular';

// Check if required fields are empty
if (empty($name) || empty($phone) || empty($email)) {
    echo json_encode(["status" => "error", "message" => "Name, phone, and email cannot be empty"]);
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email format"]);
    exit();
}

// Check for duplicate email
$check_email = "SELECT id FROM clients WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
$email_result = mysqli_query($conn, $check_email);
if (mysqli_num_rows($email_result) > 0) {
    echo json_encode(["status" => "error", "message" => "A client with this email already exists"]);
    exit();
}

// Check for duplicate phone
$check_phone = "SELECT id FROM clients WHERE phone = '" . mysqli_real_escape_string($conn, $phone) . "'";
$phone_result = mysqli_query($conn, $check_phone);
if (mysqli_num_rows($phone_result) > 0) {
    echo json_encode(["status" => "error", "message" => "A client with this phone number already exists"]);
    exit();
}

// Prepare SQL statement with all fields
$sql = "INSERT INTO clients (name, phone, email, address, birthday, gender, notes, membership_status) 
        VALUES (
            '" . mysqli_real_escape_string($conn, $name) . "', 
            '" . mysqli_real_escape_string($conn, $phone) . "', 
            '" . mysqli_real_escape_string($conn, $email) . "', 
            " . ($address ? "'" . mysqli_real_escape_string($conn, $address) . "'" : "NULL") . ", 
            " . ($birthday ? "'" . mysqli_real_escape_string($conn, $birthday) . "'" : "NULL") . ", 
            " . ($gender ? "'" . mysqli_real_escape_string($conn, $gender) . "'" : "NULL") . ", 
            " . ($notes ? "'" . mysqli_real_escape_string($conn, $notes) . "'" : "NULL") . ", 
            '" . mysqli_real_escape_string($conn, $membership_status) . "'
        )";

$result = mysqli_query($conn, $sql);

if ($result) {
    $client_id = mysqli_insert_id($conn);
    echo json_encode([
        "status" => "success", 
        "message" => "Client added successfully",
        "client_id" => $client_id
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to save client: " . mysqli_error($conn)]);
}
?>
