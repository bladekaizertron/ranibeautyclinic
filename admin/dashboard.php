<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard — Rani Beauty Clinic CMS</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header class="dash-header">
        <div class="dash-brand">
            <img src="../assets/images/logo.png" alt="Rani Beauty Clinic Logo" class="dash-logo" />
            <h2>Rani Beauty Clinic CMS</h2>
        </div>
        <div class="dash-user">
            <p>Welcome <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Admin'; ?></p>
        </div>
    </header>

    <main class="dash-main">
        <section class="dash-grid">
            <a href="edit_media.php" class="dash-card">
                <h3>Edit Media</h3>
                <p>Replace product & gallery images</p>
            </a>
            <a href="edit_content.php" class="dash-card">
                <h3>Edit Content</h3>
                <p>Modify texts & layout of homepage</p>
            </a>
        </section>
    </main>
</body>
</html>
