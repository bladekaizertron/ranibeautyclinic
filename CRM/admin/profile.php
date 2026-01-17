<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
    header("Location: ../index.html");
    exit();
}

$user_email = $_SESSION['email'];
$user_id = $_SESSION['id'];
$message = "";
$error = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Update Staff Details (Name, Phone)
    if (isset($_POST['update_profile'])) {
        $new_name = htmlspecialchars($_POST['name']);
        $new_phone = htmlspecialchars($_POST['phone']);
        
        // We only update the STAFF table, assuming logic links via email
        $sql_update_staff = "UPDATE staff SET name=?, phone=? WHERE email=?";
        $stmt = $conn->prepare($sql_update_staff);
        $stmt->bind_param("sss", $new_name, $new_phone, $user_email);
        
        if ($stmt->execute()) {
             if ($stmt->affected_rows > 0) {
                 $message = "Profile details updated successfully!";
             } else {
                 // Maybe they didn't change anything, or they don't exist in staff table
                 // Let's check if they exist in staff table first
                 $check_staff = $conn->query("SELECT * FROM staff WHERE email='$user_email'");
                 if ($check_staff->num_rows > 0) {
                     $message = "No changes made to profile.";
                 } else {
                     $error = "Staff record not found for this email. Please contact admin.";
                 }
             }
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }

    // 2. Change Password
    if (isset($_POST['change_password'])) {
        $current_pass = $_POST['current_password'];
        $new_pass = $_POST['new_password'];
        $confirm_pass = $_POST['confirm_password'];

        if ($new_pass !== $confirm_pass) {
            $error = "New passwords do not match.";
        } else {
            // Verify old password
            $sql_user = "SELECT password FROM users WHERE id=?";
            $stmt = $conn->prepare($sql_user);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($current_pass, $row['password'])) {
                    // Update to new password
                    $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                    $sql_update_pass = "UPDATE users SET password=? WHERE id=?";
                    $stmt_up = $conn->prepare($sql_update_pass);
                    $stmt_up->bind_param("si", $new_hash, $user_id);
                    if ($stmt_up->execute()) {
                        $message = "Password changed successfully!";
                    } else {
                        $error = "Error updating password.";
                    }
                } else {
                    $error = "Incorrect current password.";
                }
            }
        }
    }
}

// Fetch User & Staff Data
// Get User Data
$sql_user = "SELECT email FROM users WHERE id='$user_id'";
$res_user = mysqli_query($conn, $sql_user);
$user_data = mysqli_fetch_assoc($res_user);

// Get Staff Data (Linked by Email)
$staff_data = null;
$sql_staff = "SELECT * FROM staff WHERE email='$user_email'";
$res_staff = mysqli_query($conn, $sql_staff);
if (mysqli_num_rows($res_staff) > 0) {
    $staff_data = mysqli_fetch_assoc($res_staff);
} else {
    // Fallback if not in staff table
    $staff_data = [
        'name' => 'User',
        'phone' => '',
        'role' => 'Standard User',
        'avatar_color' => '#6c757d'
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js'></script>
	<title>My Profile | Rani Beauty Clinic</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

        :root {
            --poppins: 'Montserrat', 'Poppins', sans-serif;
            --lato: 'Montserrat', 'Lato', sans-serif;
            --playfair: 'Playfair Display', serif;
            
            /* Rani Beauty Clinic Brand Colors */
            --brand-navy: #0F1D2C;
            --brand-gold: #F3D6BE;
            --brand-gold-dark: #dcb394;
            --brand-bg: #FAF8F5;
            --brand-white: #FFFFFF;
            --brand-text: #2A2A2A;
            
            --grey: #F5F6F8;
            --dark-grey: #AAAAAA;
            --light: #fff;
            --dark: var(--brand-navy);
            --red: #DB504A;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: var(--brand-bg); font-family: var(--poppins); overflow-x: hidden; color: var(--brand-text); }
        a { text-decoration: none; }
        li { list-style: none; }

        /* SIDEBAR (Match Dashboard) */
        #sidebar {
            position: fixed; top: 0; left: 0; width: 220px; height: 100%; background: var(--light); z-index: 2000; font-family: var(--lato); transition: .3s ease;
            box-shadow: 2px 0 20px rgba(0,0,0,0.02);
        }
        #sidebar .brand {
            font-size: 24px; font-weight: 700; height: 80px; display: flex; align-items: center; color: var(--brand-navy); position: sticky; top: 0; left: 0; background: var(--light); z-index: 500; padding: 20px 0; box-sizing: border-box; font-family: var(--playfair); justify-content: center;
        }
        #sidebar .side-menu { width: 100%; margin-top: 20px; }
        #sidebar .side-menu li { height: 48px; background: transparent; margin-left: 10px; border-radius: 48px 0 0 48px; padding: 4px; }
        #sidebar .side-menu li.active { background: var(--brand-bg); position: relative; }
        #sidebar .side-menu li.active::before { content: ''; position: absolute; width: 40px; height: 40px; border-radius: 50%; top: -40px; right: 0; box-shadow: 20px 20px 0 var(--brand-bg); z-index: -1; }
        #sidebar .side-menu li.active::after { content: ''; position: absolute; width: 40px; height: 40px; border-radius: 50%; bottom: -40px; right: 0; box-shadow: 20px -20px 0 var(--brand-bg); z-index: -1; }
        #sidebar .side-menu li a { width: 100%; height: 100%; background: var(--light); display: flex; align-items: center; border-radius: 48px; font-size: 15px; color: var(--dark); white-space: nowrap; overflow-x: hidden; transition: 0.3s; }
        #sidebar .side-menu li.active a { color: var(--brand-navy); font-weight: 600; }
        #sidebar .side-menu li a:hover { color: var(--brand-navy); background: rgba(243, 214, 190, 0.2); }
        #sidebar .side-menu li a .bx { min-width: 60px; display: flex; justify-content: center; font-size: 20px; }

        /* CONTENT */
        #content { position: relative; width: calc(100% - 220px); left: 220px; transition: .3s ease; }
        
        /* NAVBAR */
        #content nav { height: 60px; background: var(--light); padding: 0 24px; display: flex; align-items: center; grid-gap: 24px; font-family: var(--lato); position: sticky; top: 0; left: 0; z-index: 1000; box-shadow: 0 2px 15px rgba(0,0,0,0.03); }
        #content nav a { color: var(--dark); }
        #content nav .bx.bx-menu { cursor: pointer; color: var(--dark); font-size: 24px; }
        #content nav .nav-link { font-weight: 600; color: var(--brand-navy); font-size: 16px; }

        /* MAIN */
        #content main { width: 100%; padding: 36px 24px; font-family: var(--poppins); max-height: calc(100vh - 60px); overflow-y: auto; }
        
        .head-title { display: flex; align-items: center; justify-content: space-between; grid-gap: 16px; flex-wrap: wrap; margin-bottom: 30px; }
        .head-title h1 { font-size: 32px; font-weight: 700; color: var(--brand-navy); font-family: var(--playfair); }
        .breadcrumb li a { color: var(--dark-grey); font-size: 14px; }
        .breadcrumb li a.active { color: var(--brand-navy); font-weight: 600; }
        .breadcrumb li .bx { margin: 0 6px; color: var(--dark-grey); }

        /* Profile Grid */
        .profile-container {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            align-items: start;
        }

        .card {
            background: var(--light);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(15, 29, 44, 0.03);
            border: 1px solid rgba(15, 29, 44, 0.03);
            transition: transform 0.3s ease;
        }
        
        /* Identity Card */
        .profile-identity {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .profile-identity::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 100px;
            background: linear-gradient(135deg, var(--brand-navy) 0%, #1a2f42 100%);
            z-index: 0;
        }
        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 52px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            position: relative;
            z-index: 1;
            margin-top: 35px;
            border: 5px solid var(--light);
            font-family: var(--playfair);
        }
        .profile-name { font-size: 26px; font-weight: 700; margin-bottom: 5px; color: var(--brand-navy); font-family: var(--playfair); }
        .profile-role { font-size: 13px; color: var(--brand-gold-dark); margin-bottom: 25px; text-transform: uppercase; letter-spacing: 2px; font-weight: 600; }
        .profile-badges { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; width: 100%; }
        .badge { padding: 8px 16px; border-radius: 30px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; }
        .badge-primary { background: rgba(15, 29, 44, 0.05); color: var(--brand-navy); }
        .badge-success { background: rgba(56, 142, 60, 0.1); color: #388E3C; }

        /* Edit Form */
        h3 { font-size: 18px; font-weight: 600; color: var(--brand-navy); margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
        h3 i { font-size: 20px; color: var(--brand-gold); }
        
        .form-group { margin-bottom: 24px; position: relative; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; color: var(--brand-navy); font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; opacity: 0.8; }
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid #E0E0E0;
            background: #FAFAFA;
            font-family: inherit;
            font-size: 15px;
            color: var(--brand-navy);
            outline: none;
            transition: all 0.3s ease;
        }
        .form-control:focus { border-color: var(--brand-gold); background: #fff; box-shadow: 0 5px 15px rgba(243, 214, 190, 0.2); }
        .form-control[readonly] { background: #f5f5f5; color: #888; border-color: #eee; cursor: not-allowed; }
        
        .btn-primary {
            background: var(--brand-navy);
            color: #fff;
            padding: 14px 40px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(15, 29, 44, 0.2);
            text-transform: uppercase;
        }
        .btn-primary:hover { background: var(--brand-gold); color: var(--brand-navy); transform: translateY(-3px); box-shadow: 0 12px 25px rgba(243, 214, 190, 0.4); }

        .form-divider { margin: 40px 0; border: 0; border-top: 1px dashed rgba(0,0,0,0.1); }

        .alert { padding: 16px 20px; border-radius: 12px; margin-bottom: 30px; font-size: 14px; display: flex; align-items: center; gap: 14px; font-weight: 500; }
        .alert-success { background: #E8F5E9; color: #2E7D32; border-left: 4px solid #2E7D32; }
        .alert-error { background: #FFEBEE; color: #C62828; border-left: 4px solid #C62828; }
        .alert i { font-size: 20px; }

        @media screen and (max-width: 900px) {
            .profile-container { grid-template-columns: 1fr; }
        }
        @media screen and (max-width: 768px) {
            #sidebar { width: 60px; }
            #content { width: calc(100% - 60px); left: 60px; }
            #sidebar .side-menu li { margin-left: 0; }
            #sidebar .brand { padding: 0; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<span class="text">Rani</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="dashboard.php#manage">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Manage</span>
				</a>
			</li>
            <li>
				<a href="dashboard.php#reports">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Reports</span>
				</a>
			</li>
			<li>
				<a href="dashboard.php#clients">
					<i class='bx bxs-group' ></i>
					<span class="text">Clients</span>
				</a>
			</li>
			<li>
				<a href="dashboard.php#marketing">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Marketing</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu bottom">
			<li class="active">
				<a href="profile.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
    
    <section id="content">
        <nav>
			<i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">Account Settings</a>
        </nav>

        <main>
            <div class="head-title">
				<div class="left">
					<h1>My Profile</h1>
					<ul class="breadcrumb">
						<li><a href="#">Dashboard</a></li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li><a class="active" href="#">Profile</a></li>
					</ul>
				</div>
			</div>

            <?php if($message): ?>
                <div class="alert alert-success"><i class='bx bxs-check-circle'></i> <?php echo $message; ?></div>
            <?php endif; ?>
            <?php if($error): ?>
                <div class="alert alert-error"><i class='bx bxs-error-circle'></i> <?php echo $error; ?></div>
            <?php endif; ?>

            <div class="profile-container">
                <!-- Left Column: Identity -->
                <div class="card profile-identity">
                    <div class="profile-avatar" style="background-color: <?php echo $staff_data['avatar_color']; ?>">
                        <?php 
                            $initials = explode(" ", $staff_data['name']);
                            echo substr($initials[0], 0, 1) . (isset($initials[1]) ? substr($initials[1], 0, 1) : '');
                        ?>
                    </div>
                    <h2 class="profile-name"><?php echo htmlspecialchars($staff_data['name']); ?></h2>
                    <p class="profile-role"><?php echo htmlspecialchars($staff_data['role']); ?></p>
                    
                    <div class="profile-badges">
                        <span class="badge badge-primary">Team Member</span>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>

                <!-- Right Column: Edit Forms -->
                <div class="card profile-edit">
                    <h3><i class='bx bxs-user-detail'></i> Edit Details</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($user_email); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($staff_data['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($staff_data['phone']); ?>">
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button type="submit" name="update_profile" class="btn-primary">Save Changes</button>
                        </div>
                    </form>

                    <hr class="form-divider">

                    <h3><i class='bx bxs-lock-alt'></i> Security</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required placeholder="Enter current password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required placeholder="Retype new password">
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button type="submit" name="change_password" class="btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </section>

    <script src="script.js"></script>
</body>
</html>
