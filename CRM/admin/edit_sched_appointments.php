<?php
include "db_conn.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid Appointment ID");
}

// Fetch appointment details
$sql = "SELECT a.*, c.name as client_name, s.name as staff_name, s.avatar_color
        FROM appointments a 
        JOIN clients c ON a.client_id = c.id 
        JOIN staff s ON a.staff_id = s.id 
        WHERE a.id = $id";
$result = mysqli_query($conn, $sql);
$appointment = mysqli_fetch_assoc($result);

if (!$appointment) {
    die("Appointment not found");
}

// Date formatting
$timestamp = strtotime($appointment['appointment_date']);
$fullDate = date('l, F j, Y', $timestamp);
$shortDate = date('D M j', $timestamp);

// Time formatting
$timeFormatted = date('g:ia', strtotime($appointment['appointment_time']));

// Booked on info
$bookedOn = date('D M j @ g:ia', strtotime($appointment['created_at'])) . ' PST';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment - <?php echo htmlspecialchars($appointment['client_name']); ?></title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap');

        :root {
            --brand-navy: #0F1D2C;
            --brand-gold: #F3D6BE;
            --brand-bg: #FAF8F5;
            --white: #FFFFFF;
            --blue: #3C91E6;
            --text-main: #2A2A2A;
            --text-soft: #7A7A7A;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
            --soft-shadow: 0 15px 40px rgba(0,0,0,0.06);
            --inner-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--brand-bg);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Full page floating wrapper */
        .glass-container {
            width: 95vw;
            height: 90vh;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 40px;
            box-shadow: var(--soft-shadow);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* Decorative blobs */
        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--brand-gold);
            filter: blur(100px);
            opacity: 0.2;
            z-index: -1;
            border-radius: 50%;
        }
        .blob-1 { top: -100px; right: -100px; }
        .blob-2 { bottom: -100px; left: -100px; background: var(--blue); }

        /* Navigation Header */
        header {
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
        }

        header .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--brand-navy);
            letter-spacing: -0.5px;
        }

        header .close-btn {
            width: 44px;
            height: 44px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--brand-navy);
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        header .close-btn:hover {
            transform: rotate(90deg);
            background: var(--brand-navy);
            color: var(--white);
        }

        /* Main content */
        .main-wrapper {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* Sidebar info */
        .sidebar {
            width: 360px;
            padding: 40px;
            border-right: 1px solid var(--glass-border);
            overflow-y: auto;
        }

        .info-group {
            margin-bottom: 32px;
        }

        .label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-soft);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .value-large {
            font-size: 20px;
            font-weight: 500;
            color: var(--brand-navy);
            text-decoration: none;
        }
        a.value-large:hover {
            color: var(--blue);
        }

        .dropdown-box {
            background: var(--white);
            padding: 16px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--inner-shadow);
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid transparent;
        }
        .dropdown-box:hover {
            border-color: var(--brand-gold);
            transform: translateY(-2px);
        }

        .booking-badge {
            margin-top: 40px;
            padding: 24px;
            background: var(--brand-navy);
            color: var(--white);
            border-radius: 24px;
            font-size: 14px;
        }
        .booking-badge .status-line {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
            color: var(--brand-gold);
            font-weight: 500;
        }

        /* Center Content */
        .content {
            flex: 1;
            padding: 40px 60px;
            overflow-y: auto;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 32px;
        }

        .content-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: var(--brand-navy);
        }

        /* Service Cards */
        .service-card {
            background: var(--white);
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: var(--soft-shadow);
            display: grid;
            grid-template-columns: 100px 1fr 200px 150px;
            align-items: center;
            gap: 24px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .service-card:hover {
            transform: scale(1.02);
        }

        .time-box {
            font-weight: 600;
            color: var(--text-soft);
        }

        .service-info .name {
            font-size: 18px;
            font-weight: 600;
            color: var(--brand-navy);
            margin-bottom: 4px;
        }
        .service-info .price {
            color: var(--blue);
            font-weight: 600;
        }

        .staff-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--brand-bg);
            padding: 10px 16px;
            border-radius: 40px;
        }
        .staff-pill .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
        }

        .duration-box {
            text-align: right;
            font-weight: 500;
            color: var(--text-soft);
        }

        /* Add Service Area */
        .add-service-trigger {
            border: 2px dashed var(--brand-gold);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            color: var(--text-soft);
            cursor: pointer;
            transition: 0.3s;
        }
        .add-service-trigger:hover {
            background: var(--white);
            color: var(--brand-navy);
            border-style: solid;
        }

        /* Notes Box */
        .notes-area {
            margin-top: 48px;
            background: var(--white);
            border-radius: 24px;
            padding: 24px;
            box-shadow: var(--inner-shadow);
        }
        .notes-area textarea {
            width: 100%;
            border: none;
            outline: none;
            resize: none;
            font-family: inherit;
            font-size: 15px;
            color: var(--text-main);
            min-height: 80px;
            background: transparent;
        }

        /* Footer */
        footer {
            padding: 24px 40px;
            background: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--glass-border);
        }

        .checklist-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: var(--brand-navy);
            color: var(--white);
            border: none;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .checklist-btn:hover { background: #1c2e40; }

        .footer-actions {
            display: flex;
            gap: 16px;
        }

        .secondary-btn {
            padding: 12px 24px;
            background: transparent;
            border: 2px solid var(--brand-gold);
            color: var(--brand-navy);
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .secondary-btn:hover { background: var(--brand-gold); }

        .primary-btn {
            padding: 12px 32px;
            background: #80C157;
            color: var(--white);
            border: none;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(128, 193, 87, 0.3);
            transition: 0.3s;
        }
        .primary-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 25px rgba(128, 193, 87, 0.4); }

    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="glass-container">
        <header>
            <div class="brand-title">Edit Appointment</div>
            <a href="dashboard.php" class="close-btn"><i class='bx bx-x'></i></a>
        </header>

        <div class="main-wrapper">
            <div class="sidebar">
                <div class="info-group">
                    <div class="label">Client</div>
                    <a href="#" class="value-large"><?php echo htmlspecialchars($appointment['client_name']); ?></a>
                </div>

                <div class="info-group">
                    <div class="label">Date</div>
                    <div class="dropdown-box">
                        <span><?php echo $fullDate; ?></span>
                        <i class='bx bx-calendar-event' style="color: var(--brand-gold);"></i>
                    </div>
                </div>

                <div class="info-group">
                    <div class="label">Location</div>
                    <div class="dropdown-box">
                        <span>Renton Clinic</span>
                        <i class='bx bx-map-alt' style="color: var(--brand-gold);"></i>
                    </div>
                </div>

                <div class="booking-badge">
                    <div style="opacity: 0.7;">Booked through platform</div>
                    <div style="font-size: 12px; margin-top: 4px; opacity: 0.5;"><?php echo $bookedOn; ?></div>
                    <div class="status-line">
                        <i class='bx bxs-check-shield'></i>
                        <span>Confirmed: <?php echo $timeFormatted; ?></span>
                    </div>
                </div>

                <div class="info-group" style="margin-top: 40px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="label">Clinical Records</span>
                        <i class='bx bx-plus-circle' style="color: var(--brand-gold); font-size: 20px; cursor: pointer;"></i>
                    </div>
                    <div style="font-size: 13px; color: var(--text-soft); margin-top: 12px; background: var(--white); padding: 12px; border-radius: 12px; box-shadow: var(--inner-shadow);">
                        No forms or charts attached.
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="content-header">
                    <h2>Scheduled Services</h2>
                    <div style="color: var(--text-soft); font-size: 14px;">1 Service Selected</div>
                </div>

                <div class="service-card">
                    <div class="time-box"><?php echo $timeFormatted; ?></div>
                    <div class="service-info">
                        <div class="name"><?php echo htmlspecialchars($appointment['services']); ?></div>
                        <div class="price">$<?php echo number_format($appointment['total_price'], 2); ?></div>
                    </div>
                    <div class="staff-pill">
                        <div class="avatar" style="background: <?php echo $appointment['avatar_color'] ?: '#9b5de5'; ?>">
                            <?php 
                                $initials = '';
                                $names = explode(' ', $appointment['staff_name']);
                                foreach($names as $n) $initials .= $n[0];
                                echo strtoupper(substr($initials, 0, 2));
                            ?>
                        </div>
                        <span style="font-size: 14px; font-weight: 500;"><?php echo htmlspecialchars($appointment['staff_name']); ?></span>
                    </div>
                    <div class="duration-box">
                        <div style="font-size: 14px;">15 min</div>
                        <div style="font-size: 11px; color: #bbb;">Treatment</div>
                    </div>
                </div>

                <div class="add-service-trigger">
                    <i class='bx bx-plus'></i>
                    <span>Add another service or transition time</span>
                </div>

                <div class="notes-area">
                    <div class="label" style="font-size: 10px; margin-bottom: 12px;">Internal Notes</div>
                    <textarea placeholder="Add a private note about this appointment..."></textarea>
                    <div style="display: flex; justify-content: flex-end; margin-top: 12px;">
                        <button class="checklist-btn" style="background: var(--brand-bg); color: var(--brand-navy); font-size: 12px; padding: 6px 16px;">
                            <i class='bx bx-tag-alt'></i> Add Tags
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <button class="checklist-btn">
                <i class='bx bx-list-check'></i>
                Onboarding Checklist
            </button>
            <div class="footer-actions">
                <button class="secondary-btn">Save Draft</button>
                <button class="primary-btn">Go to Checkout</button>
            </div>
        </footer>
    </div>
</body>
</html>
