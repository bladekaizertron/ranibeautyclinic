<?php
header('Content-Type: application/json');
include('../db_conn.php');

$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? (int)$data['id'] : 0;

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid appointment ID.']);
    exit();
}

$sql = "UPDATE appointments SET status = 'confirmed' WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Send Confirmation Email
        require_once 'mail_helper.php';
        $sentEmailAddr = sendAppointmentConfirmation($id, $conn);
        
        $msg = 'Appointment confirmed successfully.';
        if ($sentEmailAddr && is_string($sentEmailAddr) && strpos($sentEmailAddr, '@') !== false) {
            $msg .= " Email sent to: $sentEmailAddr";
        } else {
            // It failed, so $sentEmailAddr contains the error message
            $msg .= " (Failed: $sentEmailAddr)";
        }

        echo json_encode(['status' => 'success', 'message' => $msg]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Appointment already confirmed or ID not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
