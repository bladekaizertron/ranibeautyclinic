<?php
include "db_conn.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid Appointment ID");
}

// Fetch appointment details
$sql = "SELECT a.*, c.name as client_name, s.name as staff_name 
        FROM appointments a 
        JOIN clients c ON a.client_id = c.id 
        JOIN staff s ON a.staff_id = s.id 
        WHERE a.id = $id";
$result = mysqli_query($conn, $sql);
$appointment = mysqli_fetch_assoc($result);

if (!$appointment) {
    die("Appointment not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment - <?php echo htmlspecialchars($appointment['client_name']); ?></title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --brand-navy: #0F1D2C;
            --brand-gold: #F3D6BE;
            --blue: #3C91E6;
            --grey: #F9F9F9;
            --dark: #342E37;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--grey);
            padding: 40px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        h1 {
            color: var(--brand-navy);
            margin-bottom: 20px;
        }
        .info-row {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .label {
            font-weight: 600;
            color: var(--dark);
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--blue);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Appointment</h1>
        <div class="info-row">
            <span class="label">Client:</span> <?php echo htmlspecialchars($appointment['client_name']); ?>
        </div>
        <div class="info-row">
            <span class="label">Service:</span> <?php echo htmlspecialchars($appointment['services']); ?>
        </div>
        <div class="info-row">
            <span class="label">Staff:</span> <?php echo htmlspecialchars($appointment['staff_name']); ?>
        </div>
        <div class="info-row">
            <span class="label">Date:</span> <?php echo htmlspecialchars($appointment['appointment_date']); ?>
        </div>
        <div class="info-row">
            <span class="label">Time:</span> <?php echo htmlspecialchars($appointment['appointment_time']); ?>
        </div>
        
        <p style="margin-top: 20px; color: #888;">Full editing functionality coming soon...</p>
        
        <a href="dashboard.php" class="btn-back"><i class='bx bx-arrow-back'></i> Back to Dashboard</a>
    </div>
</body>
</html>
