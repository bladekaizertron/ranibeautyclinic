<?php
header('Content-Type: application/json');
include '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $dob = $_POST['dob'] ?? null;
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $contact_pref = $_POST['contact_pref'] ?? '';
    $referral = $_POST['referral'] ?? '';
    $concerns = $_POST['concerns'] ?? '';
    $areas = $_POST['areas'] ?? '';
    $treatments = $_POST['treatments'] ?? '';
    $special_event = $_POST['special_event'] ?? '';
    $recent_treatments = $_POST['recent_treatments'] ?? '';
    $medical_cond_choice = $_POST['medical_cond_choice'] ?? '';
    $medical_cond_text = $_POST['medical_cond_text'] ?? '';
    $sensitivities = $_POST['sensitivities'] ?? '';
    $habits = $_POST['habits'] ?? '';
    $water = $_POST['water'] ?? '';
    $skin_type = $_POST['skin_type'] ?? '';
    $best_days = $_POST['best_days'] ?? '';
    $best_time = $_POST['best_time'] ?? '';

    // Handle File Uploads
    $upload_dir = '../uploads/intake/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $aura_scan_path = '';
    if (isset($_FILES['aura_scan']) && $_FILES['aura_scan']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['aura_scan']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('aura_') . '.' . $ext;
        if (move_uploaded_file($_FILES['aura_scan']['tmp_name'], $upload_dir . $filename)) {
            $aura_scan_path = $filename;
        }
    }

    $routine_pics_path = '';
    if (isset($_FILES['routine_pics']) && $_FILES['routine_pics']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['routine_pics']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('routine_') . '.' . $ext;
        if (move_uploaded_file($_FILES['routine_pics']['tmp_name'], $upload_dir . $filename)) {
            $routine_pics_path = $filename;
        }
    }

    // 1. Find or Create Client
    $client_id = null;
    if (!empty($email) || !empty($phone)) {
        $stmt = $conn->prepare("SELECT id FROM clients WHERE email = ? OR phone = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $client_id = $row['id'];
        } else {
            $stmt = $conn->prepare("INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $phone);
            if ($stmt->execute()) {
                $client_id = $conn->insert_id;
            }
        }
    }

    // 2. Insert Submission
    $stmt = $conn->prepare("INSERT INTO intake_submissions (
        client_id, name, dob, email, phone, contact_pref, referral, aura_scan, 
        concerns, areas, treatments, special_event, recent_treatments, 
        medical_cond_choice, medical_cond_text, sensitivities, habits, water, 
        skin_type, best_days, best_time, routine_pics
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "isssssssssssssssssssss",
        $client_id, $name, $dob, $email, $phone, $contact_pref, $referral, $aura_scan_path,
        $concerns, $areas, $treatments, $special_event, $recent_treatments,
        $medical_cond_choice, $medical_cond_text, $sensitivities, $habits, $water,
        $skin_type, $best_days, $best_time, $routine_pics_path
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Intake form submitted successfully', 'submission_id' => $conn->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save submission: ' . $conn->error]);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
