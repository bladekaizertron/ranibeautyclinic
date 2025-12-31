<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$baseDir = realpath(__DIR__ . '/../assets/images');
if (!$baseDir) {
    die('Images directory not found.');
}

// Helper: Recursively get images
function getImages($dir) {
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $files = array_merge($files, getImages($path));
        } else {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'])) {
                $files[] = $path;
            }
        }
    }
    return $files;
}

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['target_path'])) {
    $targetPath = realpath($_POST['target_path']);
    if (!$targetPath || strpos($targetPath, $baseDir) !== 0) {
        $errorMsg = 'Invalid target path.';
    } elseif (!is_uploaded_file($_FILES['new_image']['tmp_name'])) {
        $errorMsg = 'Please select a file to upload.';
    } else {
        $ext = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'])) {
            $errorMsg = 'Invalid file type.';
        } else {
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $targetPath)) {
                $successMsg = 'Image replaced successfully!';
            } else {
                $errorMsg = 'Failed to move uploaded file.';
            }
        }
    }
}

$images = getImages($baseDir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Media — Rani Beauty Clinic CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .images-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; }
        .img-card { background:#fff; border-radius:12px; padding:0.5rem; box-shadow:0 3px 10px rgba(0,0,0,0.05); text-align:center; }
        .img-card img { max-width:100%; height:100px; object-fit:cover; border-radius:8px; }
        .img-card form { margin-top:0.5rem; }
        .img-card input[type="file"] { font-size:0.8rem; }
    </style>
</head>
<body>
    <header class="dash-header">
        <h2>Edit Media</h2>
        <nav class="dash-nav">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="edit_content.php" class="nav-link">Edit Content</a>
            <a href="logout.php" class="btn-secondary">Logout</a>
        </nav>
    </header>
    <main class="dash-main">
        <?php if ($successMsg): ?>
            <div class="success-msg"><?= htmlspecialchars($successMsg) ?></div>
        <?php elseif ($errorMsg): ?>
            <div class="error-msg"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>
        <div class="images-grid">
            <?php foreach ($images as $imgPath): $relPath = str_replace(realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR, '', $imgPath); ?>
                <div class="img-card">
                    <img src="../<?= htmlspecialchars($relPath) ?>" alt="Image" />
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="target_path" value="<?= htmlspecialchars($imgPath) ?>" />
                        <input type="file" name="new_image" accept="image/*" required />
                        <button type="submit" class="btn-primary" style="margin-top:0.3rem">Replace</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
