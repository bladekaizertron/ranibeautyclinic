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
        <h2>WELCOME, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <nav class="dash-nav">
            <a href="edit_media.php" class="nav-link">Edit Media</a>
            <a href="edit_content.php" class="nav-link">Edit Content</a>
            <a href="logout.php" class="btn-secondary">Logout</a>
        </nav>
    </header>

    <main class="dash-main">
    </main>
</body>
</html>
