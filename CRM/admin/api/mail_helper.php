<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../../assets/vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../assets/vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../assets/vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/config_email.php';

function sendAppointmentConfirmation($appointmentId, $conn) {
    // 1. Fetch Appointment Details
    $sql = "SELECT a.*, c.name as client_name, c.email as client_email, s.name as staff_name 
            FROM appointments a
            JOIN clients c ON a.client_id = c.id
            JOIN staff s ON a.staff_id = s.id
            WHERE a.id = '$appointmentId' LIMIT 1";
    
    $result = mysqli_query($conn, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        error_log("Email Error: Appointment ID $appointmentId not found.");
        return false;
    }

    $appt = mysqli_fetch_assoc($result);
    
    // 2. Format Data
    $clientName = $appt['client_name'];
    $clientEmail = $appt['client_email'];
    $staffName = $appt['staff_name'];
    $services = $appt['services'];
    $price = $appt['total_price'];
    
    // Format Date & Time
    $dateObj = new DateTime($appt['appointment_date']);
    $dateFormatted = $dateObj->format('l, F j, Y');
    
    $timeObj = new DateTime($appt['appointment_time']);
    $timeFormatted = $timeObj->format('g:i A');

    // 3. Prepare Email Body (HTML)
    // Try to fetch custom template
    $tmplSql = "SELECT subject, body FROM message_templates WHERE name='appointment_confirmation' AND type='email' LIMIT 1";
    $tmplRes = mysqli_query($conn, $tmplSql);
    
    $subject = "";
    $contentBody = "";

    if ($tmplRes && mysqli_num_rows($tmplRes) > 0) {
        $row = mysqli_fetch_assoc($tmplRes);
        $subject = $row['subject'];
        $contentBody = $row['body'];
    } else {
        // Fallback if no template found
        $subject = "Appointment Confirmed - Rani Beauty Clinic";
        $contentBody = "<p>Hello <strong>{{client_name}}</strong>,</p>
                        <p>Great news! Your appointment at Rani Beauty Clinic has been successfully confirmed.</p>
                        <div class='details'>
                            <p><strong>Date:</strong> {{appointment_date}}</p>
                            <p><strong>Time:</strong> {{appointment_time}}</p>
                            <p><strong>Staff:</strong> {{staff_name}}</p>
                            <p><strong>Services:</strong> {{service_name}}</p>
                            <p><strong>Total Price:</strong> \${{price}}</p>
                        </div>
                        <p>We look forward to seeing you soon!</p>";
    }

    // Replace Variables
    $vars = [
        '{{client_name}}' => $clientName,
        '{{appointment_date}}' => $dateFormatted,
        '{{appointment_time}}' => $timeFormatted,
        '{{staff_name}}' => $staffName,
        '{{service_name}}' => $services,
        '{{price}}' => $price
    ];
    
    foreach ($vars as $key => $val) {
        $subject = str_replace($key, $val, $subject);
        $contentBody = str_replace($key, $val, $contentBody);
    }

    // Wrap in standard HTML Container
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
            .header { background: #0F1D2C; color: #F3D6BE; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { padding: 20px; }
            .details { background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0; }
            .footer { font-size: 12px; text-align: center; color: #999; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Appointment Confirmed</h1>
            </div>
            <div class='content'>
                $contentBody
            </div>
            <div class='footer'>
                <p>&copy; " . date('Y') . " Rani Beauty Clinic. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // 4. Send Email via PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;

        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($clientEmail, $clientName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // Plain text version

        $mail->send();
        error_log("Email sent successfully to $clientEmail for Appointment #$appointmentId");
        return $clientEmail; // Return the email address on success
    } catch (Exception $e) {
        $errorMsg = "Mailer Error: {$mail->ErrorInfo}";
        error_log($errorMsg);
        return $errorMsg; // Return error string on failure
    }
}
?>
