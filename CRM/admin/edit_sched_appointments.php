<?php
include "db_conn.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid Appointment ID");
}

// Fetch appointment details
$sql = "SELECT a.*, c.name as client_name, c.phone as client_phone, c.email as client_email, s.name as staff_name, s.avatar_color
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

        /* ==========================================================================
           ULTRA-PREMIUM SURPRISE: CONCIERGE CHECKOUT REDESIGN
           ========================================================================== */
        
        .checkout-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 15, 25, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(20px) saturate(180%);
            opacity: 0;
            transition: opacity 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .checkout-overlay.show {
            display: flex;
            opacity: 1;
        }

        .checkout-modal {
            width: 95vw;
            max-width: 1280px;
            height: 85vh;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 60px;
            display: grid;
            grid-template-columns: 420px 1fr;
            box-shadow: 0 100px 200px rgba(0,0,0,0.4), 
                        inset 0 0 0 1px rgba(255,255,255,0.2);
            overflow: hidden;
            position: relative;
            transform: translateY(100px) scale(0.9);
            transition: all 0.8s cubic-bezier(0.19, 1, 0.22, 1);
            backdrop-filter: blur(40px);
        }

        .checkout-overlay.show .checkout-modal {
            transform: translateY(0) scale(1);
        }

        /* 
           SIDEBAR: DARK CONCIERGE SIGNATURE 
        */
        .checkout-sidebar {
            background: linear-gradient(160deg, rgba(15, 29, 44, 0.95) 0%, rgba(10, 15, 25, 0.98) 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            color: white;
            position: relative;
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .checkout-sidebar::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -20%;
            width: 140%;
            height: 140%;
            background: radial-gradient(circle at center, rgba(243, 214, 190, 0.03) 0%, transparent 60%);
            pointer-events: none;
        }

        .cs-concierge-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-weight: 800;
            color: var(--brand-gold);
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cs-client-signature-vertical {
            margin-bottom: 50px;
        }

        .cs-client-name {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            line-height: 1.1;
            margin-bottom: 15px;
            background: linear-gradient(to bottom, #ffffff, #d4d4d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cs-loyalty-pulse {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(243, 214, 190, 0.08);
            width: fit-content;
            padding: 10px 20px;
            border-radius: 100px;
            border: 1px solid rgba(243, 214, 190, 0.15);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: var(--brand-gold);
            border-radius: 50%;
            box-shadow: 0 0 15px var(--brand-gold);
            animation: pulse-gold 2s infinite;
        }

        @keyframes pulse-gold {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }

        .pulse-text {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--brand-gold);
        }

        .cs-contact-stack {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 40px;
        }

        .cs-contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: rgba(255,255,255,0.6);
            transition: all 0.3s;
        }

        .cs-contact-item i {
            font-size: 20px;
            color: var(--brand-gold);
        }

        .cs-contact-item:hover {
            color: white;
            transform: translateX(5px);
        }

        /* 
           MAIN: LUMINOUS LUXE RECEIPT 
        */
        .checkout-main {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(50px);
            padding: 50px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-y: auto;
        }

        .checkout-close-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s;
            z-index: 10;
        }

        .checkout-close-btn:hover {
            transform: rotate(90deg) scale(1.1);
            background: var(--brand-navy);
            color: white;
        }

        .cm-luxe-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 800;
            color: var(--brand-navy);
            margin-bottom: 40px;
            display: block;
        }

        /* DIGITAL LUXE RECEIPT */
        .cm-digital-slip {
            background: white;
            border-radius: 40px;
            padding: 50px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.03);
            border: 1px solid rgba(255,255,255,1);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .cm-digital-slip::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10px;
            background: repeating-linear-gradient(45deg, var(--brand-bg), var(--brand-bg) 10px, transparent 10px, transparent 20px);
            opacity: 0.3;
        }

        .slip-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px dashed rgba(15, 29, 44, 0.08);
        }

        .slip-row:last-child { border-bottom: none; }

        .slip-row.total {
            margin-top: 20px;
            padding-top: 30px;
            border-top: 2px solid var(--brand-navy);
        }

        .slip-label {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-soft);
        }

        .slip-value {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--brand-navy);
        }

        .slip-row.total .slip-label {
            font-size: 24px;
            color: var(--brand-navy);
            font-weight: 800;
        }

        .slip-row.total .slip-value {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: var(--brand-navy);
        }

        /* PAYMENT FOCUS: CASH SPECIAL */
        .cm-cash-focus {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            padding: 25px 35px;
            background: rgba(128, 193, 87, 0.05);
            border: 1px solid rgba(128, 193, 87, 0.1);
            border-radius: 25px;
        }

        .cm-cash-icon {
            width: 60px;
            height: 60px;
            background: #80C157;
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 10px 25px rgba(128, 193, 87, 0.3);
        }

        .cm-cash-text h4 {
            font-size: 18px;
            color: var(--brand-navy);
            margin-bottom: 4px;
        }

        .cm-cash-text span {
            font-size: 13px;
            color: var(--text-soft);
            font-weight: 500;
        }

        /* THE MOMENT OF VALUE: ACTION AREA */
        .cm-action-focal {
            margin-top: auto;
            display: flex;
            gap: 20px;
        }

        .cm-amount-hero {
            flex: 1;
            background: var(--brand-navy);
            border-radius: 35px;
            padding: 25px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 20px 50px rgba(15, 29, 44, 0.2);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .cm-amount-hero .label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--brand-gold);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .cm-amount-hero .value {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            color: white;
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .cm-amount-hero .value span { font-size: 24px; color: var(--brand-gold); }

        .cm-ultimate-charge-btn {
            width: 320px;
            background: var(--brand-gold);
            border: none;
            border-radius: 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(243, 214, 190, 0.3);
        }

        .cm-ultimate-charge-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(35deg, transparent, rgba(255,255,255,0.4), transparent);
            transform: rotate(25deg);
            transition: all 0.8s;
            pointer-events: none;
        }

        .cm-ultimate-charge-btn:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 40px 80px rgba(243, 214, 190, 0.5);
            background: #f8e4d3;
        }

        .cm-ultimate-charge-btn:hover::after {
            left: 100%;
        }

        .cm-ultimate-charge-btn .btn-text {
            font-size: 16px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--brand-navy);
        }

        .cm-ultimate-charge-btn i {
            font-size: 28px;
            color: var(--brand-navy);
            transition: transform 0.4s;
        }

        .cm-ultimate-charge-btn:hover i {
            transform: translateX(10px) scale(1.2);
        }

        /* Mobile adjustments: ensure transparency carries well */
        @media (max-width: 900px) {
            .checkout-modal {
                grid-template-columns: 1fr;
                height: 95vh;
                border-radius: 40px;
            }
            .checkout-sidebar { padding: 40px; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .checkout-main { padding: 40px; }
            .cm-action-focal { flex-direction: column; }
            .cm-ultimate-charge-btn { width: 100%; padding: 30px; }
        }

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
                <button class="primary-btn" id="go-to-checkout">Go to Checkout</button>
            </div>
        </footer>
    </div>

    <!-- ULTRA-PREMIUM CONCIERGE CHECKOUT MODAL -->
    <div class="checkout-overlay" id="checkout-overlay">
        <div class="checkout-modal">
            <!-- DARK SIDEBAR: Concierge Signature -->
            <aside class="checkout-sidebar">
                <div class="cs-concierge-label">Concierge Checkout</div>
                
                <div class="cs-client-signature-vertical">
                    <h1 class="cs-client-name"><?php echo htmlspecialchars($appointment['client_name']); ?></h1>
                    <div class="cs-loyalty-pulse">
                        <div class="pulse-dot"></div>
                        <span class="pulse-text">Loyalty Phase Active</span>
                    </div>
                </div>

                <div class="cs-concierge-label" style="margin-bottom: 15px;">Assigned Tags</div>
                <div class="cs-tags" style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 40px;">
                    <span class="cs-tag" style="background: rgba(243, 214, 190, 0.1); color: var(--brand-gold); border: 1px solid rgba(243, 214, 190, 0.2); padding: 6px 14px; border-radius: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase;">VIP Elite</span>
                    <span class="cs-tag" style="background: rgba(255, 255, 255, 0.05); color: white; border: 1px solid rgba(255,255,255,0.1); padding: 6px 14px; border-radius: 12px; font-size: 11px; font-weight: 600;">Facial Regular</span>
                </div>

                <div class="cs-contact-stack">
                    <div class="cs-contact-item">
                        <i class='bx bx-phone-call'></i>
                        <span><?php echo htmlspecialchars($appointment['client_phone']); ?></span>
                    </div>
                    <div class="cs-contact-item">
                        <i class='bx bx-envelope'></i>
                        <span><?php echo htmlspecialchars($appointment['client_email']); ?></span>
                    </div>
                    <div class="cs-contact-item" style="margin-top: 10px; font-style: italic; font-size: 12px; opacity: 0.8;">
                        "Client prefers morning slots and botanical-based facial oils."
                    </div>
                </div>
            </aside>

            <!-- LUMINOUS MAIN: Luxe Receipt & Action -->
            <main class="checkout-main">
                <div class="checkout-close-btn" id="close-checkout">
                    <i class='bx bx-x'></i>
                </div>

                <span class="cm-luxe-label">Digital Invoice Summary</span>

                <!-- THE DIGITAL SLIP -->
                <div class="cm-digital-slip">
                    <div class="slip-row">
                        <span class="slip-label">Clinical Procedures</span>
                        <span class="slip-value"><?php echo htmlspecialchars($appointment['services']); ?></span>
                    </div>
                    <div class="slip-row">
                        <span class="slip-label">Base Treatment Fee</span>
                        <span class="slip-value">$<?php echo number_format($appointment['total_price'], 2); ?></span>
                    </div>
                    <div class="slip-row">
                        <span class="slip-label">Gratuity & Service</span>
                        <span class="slip-value">$0.00</span>
                    </div>
                    <div class="slip-row total">
                        <span class="slip-label">Grand Total</span>
                        <span class="slip-value">$<?php echo number_format($appointment['total_price'], 2); ?></span>
                    </div>
                </div>

                <!-- CASH FOCUS INDICATOR -->
                <div class="cm-cash-focus">
                    <div class="cm-cash-icon">
                        <i class='bx bx-money'></i>
                    </div>
                    <div class="cm-cash-text">
                        <h4>Physical Cash Tender</h4>
                        <span>Primary payment method selected for this session.</span>
                    </div>
                </div>

                <!-- MOMENT OF VALUE: ACTION AREA -->
                <div class="cm-action-focal">
                    <div class="cm-amount-hero">
                        <span class="label">Amount to Process</span>
                        <div class="value">
                            <span>$</span>
                            <?php echo number_format($appointment['total_price'], 2); ?>
                        </div>
                    </div>
                    <button class="cm-ultimate-charge-btn" id="finish-checkout">
                        <span class="btn-text">Complete Payment</span>
                        <i class='bx bx-chevron-right'></i>
                    </button>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Elite Modal Orchestration
        const overlay = document.getElementById('checkout-overlay');
        const openBtn = document.getElementById('go-to-checkout');
        const closeBtn = document.getElementById('close-checkout');

        openBtn.addEventListener('click', () => {
            overlay.classList.add('show');
            // Force reflow for transform animation
            void overlay.offsetWidth;
        });

        const closeCheckout = () => {
            overlay.classList.remove('show');
        };

        closeBtn.addEventListener('click', closeCheckout);

        // Close on overlay click
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeCheckout();
        });

        // Finish Checkout Animation & API Call
        const finishBtn = document.getElementById('finish-checkout');
        finishBtn.addEventListener('click', () => {
            const appointmentId = <?php echo $id; ?>;
            
            finishBtn.style.transform = 'scale(0.95)';
            finishBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin" style="font-size: 32px; color: var(--brand-navy);"></i>';
            finishBtn.disabled = true;
            
            fetch('api/api_complete_payment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: appointmentId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    // Slight delay for premium feel
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 1000);
                } else {
                    alert('Error processing payment: ' + (data.message || 'Unknown error'));
                    finishBtn.disabled = false;
                    finishBtn.innerHTML = '<span class="btn-text">Complete Payment</span><i class="bx bx-chevron-right"></i>';
                }
            })
            .catch(err => {
                console.error('Fetch error:', err);
                alert('Connection error. Please try again.');
                finishBtn.disabled = false;
                finishBtn.innerHTML = '<span class="btn-text">Complete Payment</span><i class="bx bx-chevron-right"></i>';
            });
        });
    </script>
</body>
</html>
