<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
    header("Location: ../index.html");
    exit();
}

$user_email = $_SESSION['email'];

// --- AUTO-SETUP REMOVED ---
// Please import message_templates.sql into your database to use this feature.


$message = "";
$error = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_template'])) {
    $id = $_POST['template_id'];
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $body = $_POST['body'];
    
    $stmt = $conn->prepare("UPDATE message_templates SET subject=?, body=? WHERE id=?");
    $stmt->bind_param("ssi", $subject, $body, $id);
    
    if ($stmt->execute()) {
        $message = "Template updated successfully!";
    } else {
        $error = "Error updating template: " . $conn->error;
    }
}

// Fetch Templates
$templates = [];
$res = $conn->query("SELECT * FROM message_templates ORDER BY type, name");
while ($row = $res->fetch_assoc()) {
    $templates[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Settings | Rani Beauty Clinic</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

        :root {
            --poppins: 'Montserrat', 'Poppins', sans-serif;
            --lato: 'Montserrat', 'Lato', sans-serif;
            --playfair: 'Playfair Display', serif;
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

        /* SIDEBAR */
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
        #content nav .bx.bx-menu { cursor: pointer; color: var(--dark); font-size: 24px; }
        #content nav .nav-link { font-weight: 600; color: var(--brand-navy); font-size: 16px; }

        /* MAIN */
        #content main { width: 100%; padding: 36px 24px; font-family: var(--poppins); max-height: calc(100vh - 60px); overflow-y: auto; }
        
        .head-title { display: flex; align-items: center; justify-content: space-between; grid-gap: 16px; flex-wrap: wrap; margin-bottom: 30px; }
        .head-title h1 { font-size: 32px; font-weight: 700; color: var(--brand-navy); font-family: var(--playfair); }
        .breadcrumb li a { color: var(--dark-grey); font-size: 14px; }
        .breadcrumb li a.active { color: var(--brand-navy); font-weight: 600; }
        
        .settings-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            align-items: start;
        }

        /* Template List */
        .template-list {
            background: var(--light);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            height: fit-content;
        }
        .template-group-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--dark-grey);
            font-weight: 700;
            margin: 15px 0 10px 10px;
        }
        .template-item {
            padding: 12px 15px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--brand-navy);
            font-size: 14px;
            margin-bottom: 5px;
        }
        .template-item:hover { background: var(--grey); }
        .template-item.active { background: var(--brand-gold); color: var(--brand-navy); font-weight: 600; box-shadow: 0 4px 10px rgba(243, 214, 190, 0.4); }
        .template-item i { font-size: 18px; }

        /* Editor */
        .editor-card {
            background: var(--light);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(15, 29, 44, 0.03);
            border: 1px solid rgba(15, 29, 44, 0.03);
        }
        .editor-header { margin-bottom: 30px; border-bottom: 1px dashed rgba(0,0,0,0.1); padding-bottom: 20px; }
        .editor-title { font-size: 24px; font-weight: 700; color: var(--brand-navy); font-family: var(--playfair); margin-bottom: 5px; }
        .editor-desc { font-size: 14px; color: var(--brand-gold-dark); }

        .form-group { margin-bottom: 24px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; color: var(--brand-navy); font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; opacity: 0.8; }
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid #E0E0E0;
            background: #FAFAFA;
            font-family: inherit; /* Inherit font-family first */
            font-size: 15px;
            color: var(--brand-navy);
            outline: none;
            transition: all 0.3s ease;
        }
        /* Specific font for textarea to ensure readability of code/tags */
        textarea.form-control { font-family: 'Consolas', 'Monaco', 'Courier New', monospace; line-height: 1.6; }
        
        .form-control:focus { border-color: var(--brand-gold); background: #fff; box-shadow: 0 5px 15px rgba(243, 214, 190, 0.2); }
        
        .variables-list {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .var-chip {
            background: rgba(15, 29, 44, 0.05);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: var(--brand-navy);
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
            font-family: monospace;
        }
        .var-chip:hover { border-color: var(--brand-navy); background: #fff; }

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

        .alert { padding: 16px 20px; border-radius: 12px; margin-bottom: 30px; font-size: 14px; display: flex; align-items: center; gap: 14px; font-weight: 500; }
        .alert-success { background: #E8F5E9; color: #2E7D32; border-left: 4px solid #2E7D32; }
        .alert-error { background: #FFEBEE; color: #C62828; border-left: 4px solid #C62828; }

        /* Hide all forms by default, show active */
        .template-form { display: none; }
        .template-form.active { display: block; }

        @media screen and (max-width: 768px) {
            .settings-container { grid-template-columns: 1fr; }
            #sidebar { width: 60px; }
            #content { width: calc(100% - 60px); left: 60px; }
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
			<li><a href="dashboard.php" title="Dashboard"><i class='bx bxs-dashboard' ></i><span class="text">Dashboard</span></a></li>
            <li><a href="dashboard.php#manage"><i class='bx bxs-shopping-bag-alt' ></i><span class="text">Manage</span></a></li>
            <li><a href="dashboard.php#reports"><i class='bx bxs-doughnut-chart' ></i><span class="text">Reports</span></a></li>
			<li><a href="dashboard.php#clients"><i class='bx bxs-group' ></i><span class="text">Clients</span></a></li>
            <li><a href="dashboard.php#marketing"><i class='bx bxs-message-dots' ></i><span class="text">Marketing</span></a></li>
		</ul>
		<ul class="side-menu bottom">
            <li><a href="profile.php"><i class='bx bxs-user-circle' ></i><span class="text">My Profile</span></a></li>
			<li class="active"><a href="settings.php"><i class='bx bxs-cog' ></i><span class="text">Settings</span></a></li>
			<li><a href="logout.php" class="logout"><i class='bx bxs-log-out-circle' ></i><span class="text">Logout</span></a></li>
		</ul>
	</section>

	<section id="content">
		<nav>
			<i class='bx bx-menu' ></i>
            <span class="nav-link">Settings</span>
		</nav>

		<main>
			<div class="head-title">
				<div class="left">
					<h1>Communication Templates</h1>
					<ul class="breadcrumb">
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li><a class="active" href="#">Settings</a></li>
					</ul>
				</div>
			</div>

            <?php if($message): ?>
                <div class="alert alert-success"><i class='bx bxs-check-circle'></i> <?php echo $message; ?></div>
            <?php endif; ?>
            <?php if($error): ?>
                <div class="alert alert-error"><i class='bx bxs-error-circle'></i> <?php echo $error; ?></div>
            <?php endif; ?>

            <div class="settings-container">
                <!-- Sidebar List -->
                <div class="template-list">
                    <div class="template-group-title">Email Templates</div>
                    <?php foreach($templates as $idx => $t): ?>
                        <?php if($t['type'] == 'email'): ?>
                            <div class="template-item <?php echo $idx === 0 ? 'active' : ''; ?>" onclick="showTemplate(<?php echo $idx; ?>, this)">
                                <i class='bx bxs-envelope'></i>
                                <?php echo ucwords(str_replace('_', ' ', $t['name'])); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="template-group-title">SMS Templates</div>
                    <?php foreach($templates as $idx => $t): ?>
                        <?php if($t['type'] == 'sms'): ?>
                            <div class="template-item" onclick="showTemplate(<?php echo $idx; ?>, this)">
                                <i class='bx bxs-message-rounded-detail'></i>
                                <?php echo ucwords(str_replace('_', ' ', $t['name'])); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Editor -->
                <div class="editor-card">
                    <?php foreach($templates as $idx => $t): ?>
                        <div id="form-<?php echo $idx; ?>" class="template-form <?php echo $idx === 0 ? 'active' : ''; ?>">
                            <div class="editor-header">
                                <h2 class="editor-title"><?php echo ucwords(str_replace('_', ' ', $t['name'])); ?></h2>
                                <p class="editor-desc"><?php echo htmlspecialchars($t['description']); ?></p>
                            </div>

                            <form method="POST" action="">
                                <input type="hidden" name="template_id" value="<?php echo $t['id']; ?>">
                                
                                <div class="form-group">
                                    <label>Channel</label>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <span class="var-chip" style="background:var(--brand-navy); color:white; cursor:default;">
                                            <?php echo strtoupper($t['type']); ?>
                                        </span>
                                    </div>
                                </div>

                                <?php if($t['type'] == 'email'): ?>
                                <div class="form-group">
                                    <label>Subject Line</label>
                                    <input type="text" name="subject" class="form-control" value="<?php echo htmlspecialchars($t['subject']); ?>" required>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>Message Content</label>
                                    <textarea name="body" class="form-control" rows="10" required id="body-<?php echo $idx; ?>"><?php echo htmlspecialchars($t['body']); ?></textarea>
                                    
                                    <div class="variables-list">
                                        <span onclick="insertVar('{{client_name}}', <?php echo $idx; ?>)" class="var-chip">{{client_name}}</span>
                                        <span onclick="insertVar('{{service_name}}', <?php echo $idx; ?>)" class="var-chip">{{service_name}}</span>
                                        <span onclick="insertVar('{{appointment_date}}', <?php echo $idx; ?>)" class="var-chip">{{appointment_date}}</span>
                                        <span onclick="insertVar('{{appointment_time}}', <?php echo $idx; ?>)" class="var-chip">{{appointment_time}}</span>
                                    </div>
                                </div>

                                <div style="text-align: right;">
                                    <button type="submit" name="save_template" class="btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
		</main>
	</section>

    <script>
        function showTemplate(index, element) {
            // Hide all forms
            document.querySelectorAll('.template-form').forEach(f => f.classList.remove('active'));
            // Show selected
            document.getElementById('form-' + index).classList.add('active');
            
            // Update sidebar active state
            document.querySelectorAll('.template-item').forEach(i => i.classList.remove('active'));
            element.classList.add('active');
        }

        function insertVar(text, index) {
            const textarea = document.getElementById('body-' + index);
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const value = textarea.value;
            
            textarea.value = value.substring(0, start) + text + value.substring(end);
            textarea.selectionStart = textarea.selectionEnd = start + text.length;
            textarea.focus();
        }

        // Sidebar toggle
        const menuBar = document.querySelector('#content nav .bx.bx-menu');
        const sidebar = document.getElementById('sidebar');
        menuBar.addEventListener('click', function () {
            sidebar.classList.toggle('hide');
        });
    </script>
</body>
</html>
