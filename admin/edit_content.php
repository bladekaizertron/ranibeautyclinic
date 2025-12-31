<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$siteFile = realpath(__DIR__ . '/../index.html');
if (!$siteFile || !is_writable($siteFile)) {
    die('index.html is not writable. Please adjust file permissions.');
}

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['html_content'] ?? '';
    if ($newContent === '') {
        $errorMsg = 'Content cannot be empty.';
    } else {
        if (file_put_contents($siteFile, $newContent) !== false) {
            $successMsg = 'index.html updated successfully!';
        } else {
            $errorMsg = 'Failed to write to index.html.';
        }
    }
}

$currentContent = file_get_contents($siteFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Content — Rani Beauty Clinic CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <style>
        textarea#html_content { width: 100%; min-height: 75vh; font-family: monospace; font-size: 0.9rem; }
    </style>
</head>
<body>
    <header class="dash-header">
        <h2>Edit Content</h2>
        <nav class="dash-nav">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="edit_media.php" class="nav-link">Edit Media</a>
            <a href="logout.php" class="btn-secondary">Logout</a>
        </nav>
    </header>
    <main class="dash-main">
        <?php if ($successMsg): ?>
            <div class="success-msg"><?= htmlspecialchars($successMsg) ?></div>
        <?php elseif ($errorMsg): ?>
            <div class="error-msg"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <textarea id="html_content" name="html_content" required><?= htmlspecialchars($currentContent) ?></textarea>
            <button type="submit" class="btn-primary" style="margin-top:1rem">Save Changes</button>
        </form>
    </main>
</body>
</html>
