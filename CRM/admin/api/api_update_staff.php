<?php
include '../db_conn.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['original_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Original staff name identifier missing']);
    exit;
}

$original_name = $data['original_name'];
$firstname = trim($data['firstname']);
$lastname = trim($data['lastname']);
$name = $firstname . ' ' . $lastname;
$email = trim($data['email']);
$phone = trim($data['phone']);
$role = trim($data['role']);
$alias = isset($data['alias']) ? trim($data['alias']) : '';
$bio = isset($data['bio']) ? trim($data['bio']) : '';
$permission_group = isset($data['permission_group']) ? trim($data['permission_group']) : 'provider';
$location = isset($data['location']) ? trim($data['location']) : 'renton';
$avatar_color = isset($data['avatar_color']) ? trim($data['avatar_color']) : '#9b5de5';

// Find staff by original name to get ID
$stmt = mysqli_prepare($conn, "SELECT id FROM staff WHERE name = ?");
mysqli_stmt_bind_param($stmt, "s", $original_name);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$staff = mysqli_fetch_assoc($res);

if (!$staff) {
    echo json_encode(['status' => 'error', 'message' => 'Staff not found']);
    exit;
}

$id = $staff['id'];

$sql = "UPDATE staff SET 
        name = ?, 
        email = ?, 
        phone = ?, 
        role = ?, 
        alias = ?, 
        bio = ?, 
        permission_group = ?, 
        location = ?, 
        avatar_color = ? 
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssssssi", $name, $email, $phone, $role, $alias, $bio, $permission_group, $location, $avatar_color, $id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success', 'message' => 'Staff profile updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile: ' . mysqli_error($conn)]);
}
?>
