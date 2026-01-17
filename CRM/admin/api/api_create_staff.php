<?php
header("Content-Type: application/json");
include '../db_conn.php';

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validation
if (!isset($data['firstname']) || !isset($data['lastname']) || !isset($data['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'First name, last name, and email are required']);
    exit;
}

$firstname = trim($data['firstname']);
$lastname = trim($data['lastname']);
$email = trim($data['email']);
$phone = isset($data['phone']) ? trim($data['phone']) : '';
$role = isset($data['role']) ? trim($data['role']) : 'Staff';
$permission_group = isset($data['permission_group']) ? trim($data['permission_group']) : 'provider';
$location = isset($data['location']) ? trim($data['location']) : 'renton';

// Combine names
$name = $firstname . ' ' . $lastname;

// Default avatar color
$colors = ['#00bcd4', '#9b5de5', '#2ecc71', '#f39c12', '#e91e63', '#8bc34a', '#2196f3', '#009688'];
$avatar_color = $colors[array_rand($colors)];

// Check for duplicate email
$check_sql = "SELECT id FROM staff WHERE email = ?";
$check_stmt = mysqli_prepare($conn, $check_sql);
mysqli_stmt_bind_param($check_stmt, "s", $email);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if (mysqli_stmt_num_rows($check_stmt) > 0) {
    echo json_encode(['status' => 'error', 'message' => 'A staff member with this email already exists']);
    exit;
}

// Insert new staff
$sql = "INSERT INTO staff (name, email, phone, role, permission_group, location, avatar_color) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $phone, $role, $permission_group, $location, $avatar_color);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success', 'message' => 'Staff member created successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
}
?>
