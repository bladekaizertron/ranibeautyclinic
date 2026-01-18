<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$dataFile = __DIR__ . '/data/gallery.json';
$uploadDir = __DIR__ . '/../assets/images/gallery/';

// Ensure directories
if (!file_exists(dirname($dataFile))) {
    @mkdir(dirname($dataFile), 0777, true);
}
if (!file_exists($uploadDir)) {
    @mkdir($uploadDir, 0777, true);
}

// Handle POST Requests (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    // 1. UPDATE DATA (JSON payload)
    if (strpos($contentType, 'application/json') !== false) {
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';

        if ($action === 'update_data') {
            $data = $input['data'] ?? null;
            if (!$data) {
                echo json_encode(['error' => 'No data provided']);
                exit();
            }

            if (file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT))) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Failed to save data.']);
            }
            exit();
        }
    } 
    // 2. UPLOAD IMAGE (Multipart Form)
    else {
        $action = $_POST['action'] ?? '';

        if ($action === 'upload_image') {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['error' => 'Image upload failed']);
                exit();
            }

            $file = $_FILES['image'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (!in_array($ext, $allowed)) {
                echo json_encode(['error' => 'Invalid file type']);
                exit();
            }

            $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $ext;
            $targetPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $relativePath = 'assets/images/gallery/' . $filename;
                echo json_encode(['success' => true, 'path' => $relativePath]);
            } else {
                echo json_encode(['error' => 'Failed to move uploaded file']);
            }
            exit();
        }
    }
    
    // Unknown action
    echo json_encode(['error' => 'Invalid action']);
    exit(); 
}

// GET Logic: Load Data for UI
$data = ['pageContent' => [], 'galleryItems' => []];
if (file_exists($dataFile)) {
    $data = json_decode(file_get_contents($dataFile), true) ?? $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Before & After Gallery - Rani Beauty Clinic</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=2">
    <style>
        html, body {
            overflow: auto !important;
            height: auto !important;
        }
        .cms-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary-navy);
            font-size: 1.5rem;
            margin: 0;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
        }
        .btn-primary {
            background: var(--primary-navy);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #1a2f45;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }

        /* Gallery Grid */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .item-card {
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            transition: transform 0.2s;
        }
        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .item-preview {
            height: 200px;
            display: flex;
            background: #f9f9f9;
        }
        .preview-half {
            width: 50%;
            height: 100%;
            object-fit: cover;
        }
        .item-details {
            padding: 1rem;
        }
        .item-actions {
            padding: 1rem;
            background: #f9f9f9;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background: var(--accent-gold);
            color: var(--primary-navy);
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
        }
        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }
        .image-upload-preview {
            width: 100%;
            height: 150px;
            background: #eee;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.5rem;
            overflow: hidden;
            border: 2px dashed #ccc;
            cursor: pointer;
        }
        .image-upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .preview-placeholder {
            color: #888;
            font-size: 0.9rem;
        }
    </style>
</head>
<body style="background: #f4f7f6;">
    <div class="cms-container">
        <header style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <div>
                <h1 style="font-family: 'Playfair Display'; color: #0F1D2C; margin:0;">Before & After Gallery</h1>
                <p style="color: #666; margin:0.5rem 0 0;">Manage gallery content and page text</p>
            </div>
            <a href="dashboard.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </header>

        <!-- Page Text Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Page Content</h2>
                <button onclick="savePageContent()" class="btn-primary">Save Changes</button>
            </div>
            <div class="form-group">
                <label class="form-label">Hero Title</label>
                <input type="text" id="heroTitle" class="form-control" value="<?= htmlspecialchars($data['pageContent']['heroTitle'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Hero Subtitle</label>
                <textarea id="heroSubtitle" class="form-control" rows="3"><?= htmlspecialchars($data['pageContent']['heroSubtitle'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Gallery Items Section -->
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Gallery Items</h2>
                <button onclick="openModal()" class="btn-primary"><i class="fas fa-plus"></i> Add New Item</button>
            </div>
            <div class="items-grid" id="itemsList">
                <!-- Javascript will populate this -->
            </div>
        </div>
    </div>

    <!-- Edit/Add Modal -->
    <div class="modal" id="itemModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 class="section-title" id="modalTitle">Add New Item</h2>
            <form id="itemForm" onsubmit="event.preventDefault(); saveItem();">
                <input type="hidden" id="itemId">
                
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select id="itemCategory" class="form-control" required>
                        <option value="injectables">Injectables</option>
                        <option value="skin">Skin Treatments</option>
                        <option value="laser">Laser</option>
                        <option value="body">Body Contouring</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" id="itemTitle" class="form-control" required placeholder="e.g. Lip Enhancement">
                </div>

                <div class="form-group">
                    <label class="form-label">Treatment Name</label>
                    <input type="text" id="itemTreatment" class="form-control" required placeholder="e.g. Dermal Fillers">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea id="itemDescription" class="form-control" rows="3" required></textarea>
                </div>

                <div style="display:flex; gap:1rem;">
                    <div class="form-group" style="flex:1;">
                        <label class="form-label">Before Image</label>
                        <input type="file" id="beforeFile" hidden accept="image/*" onchange="previewImage(this, 'beforePreview')">
                        <input type="hidden" id="beforePath">
                        <div class="image-upload-preview" onclick="document.getElementById('beforeFile').click()">
                            <div id="beforePreview"><span class="preview-placeholder">Click to Upload</span></div>
                        </div>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label class="form-label">After Image</label>
                        <input type="file" id="afterFile" hidden accept="image/*" onchange="previewImage(this, 'afterPreview')">
                        <input type="hidden" id="afterPath">
                        <div class="image-upload-preview" onclick="document.getElementById('afterFile').click()">
                            <div id="afterPreview"><span class="preview-placeholder">Click to Upload</span></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width:100%; margin-top:1rem;">Save Item</button>
            </form>
        </div>
    </div>

    <script>
        // Initial Data
        let galleryItems = <?= json_encode($data['galleryItems'] ?? []) ?>;
        const API_URL = 'edit_before_after.php'; // Post to self
        
        // Render List
        function renderItems() {
            const grid = document.getElementById('itemsList');
            grid.innerHTML = galleryItems.map(item => `
                <div class="item-card">
                    <div class="item-preview">
                        <img src="../${item.beforeImage}" class="preview-half" alt="Before">
                        <img src="../${item.afterImage}" class="preview-half" alt="After">
                    </div>
                    <div class="item-details">
                        <span class="badge">${item.category}</span>
                        <h3 style="font-size:1.1rem; margin:0.5rem 0;">${item.title}</h3>
                        <p style="color:#666; font-size:0.9rem; margin:0;">${item.treatment}</p>
                    </div>
                    <div class="item-actions">
                        <button onclick="editItem('${item.id}')" class="btn-secondary" style="padding:0.4rem 0.8rem; font-size:0.8rem;"><i class="fas fa-edit"></i> Edit</button>
                        <button onclick="deleteItem('${item.id}')" class="btn-secondary" style="background:#fff0f0; border-color:#ffcccc; color:#d9534f; padding:0.4rem 0.8rem; font-size:0.8rem;"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `).join('');
        }

        // --- Data Logic ---
        
        async function saveData(type = 'update_data') {
            const data = {
                pageContent: {
                    heroTitle: document.getElementById('heroTitle').value,
                    heroSubtitle: document.getElementById('heroSubtitle').value
                },
                galleryItems: galleryItems
            };

            const payload = {
                action: 'update_data',
                data: data
            };

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                
                const text = await response.text();
                try {
                    const result = JSON.parse(text);
                    if(result.success) {
                        alert('Saved successfully!');
                    } else {
                        alert('Error: ' + (result.error || 'Unknown error'));
                    }
                } catch (e) {
                    console.error('Server response:', text);
                    alert('Server Error ' + response.status + ': [' + text.substring(0, 150) + ']');
                }
            } catch(e) {
                alert('Connection error: ' + e.message);
                console.error(e);
            }
        }

        function savePageContent() {
            saveData();
        }

        // --- Item Management ---

        function openModal(itemId = null) {
            const modal = document.getElementById('itemModal');
            document.getElementById('itemForm').reset();
            document.getElementById('beforePreview').innerHTML = '<span class="preview-placeholder">Click to Upload</span>';
            document.getElementById('afterPreview').innerHTML = '<span class="preview-placeholder">Click to Upload</span>';
            document.getElementById('beforePath').value = '';
            document.getElementById('afterPath').value = '';

            if(itemId) {
                const item = galleryItems.find(i => i.id === itemId);
                if(item) {
                    document.getElementById('itemId').value = item.id;
                    document.getElementById('modalTitle').innerText = 'Edit Item';
                    document.getElementById('itemCategory').value = item.category;
                    document.getElementById('itemTitle').value = item.title;
                    document.getElementById('itemTreatment').value = item.treatment;
                    document.getElementById('itemDescription').value = item.description;
                    
                    // Set images
                    if(item.beforeImage) {
                        document.getElementById('beforePath').value = item.beforeImage;
                        document.getElementById('beforePreview').innerHTML = `<img src="../${item.beforeImage}">`;
                    }
                    if(item.afterImage) {
                        document.getElementById('afterPath').value = item.afterImage;
                        document.getElementById('afterPreview').innerHTML = `<img src="../${item.afterImage}">`;
                    }
                }
            } else {
                document.getElementById('itemId').value = '';
                document.getElementById('modalTitle').innerText = 'Add New Item';
            }
            
            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('itemModal').classList.remove('active');
        }

        async function saveItem() {
            const id = document.getElementById('itemId').value;
            const isNew = !id;
            
            const newItem = {
                id: id || 'item_' + Date.now(),
                category: document.getElementById('itemCategory').value,
                title: document.getElementById('itemTitle').value,
                treatment: document.getElementById('itemTreatment').value,
                description: document.getElementById('itemDescription').value,
                beforeImage: document.getElementById('beforePath').value,
                afterImage: document.getElementById('afterPath').value
            };

            if(!newItem.beforeImage || !newItem.afterImage) {
                alert('Please upload both images');
                return;
            }

            if(isNew) {
                galleryItems.push(newItem);
            } else {
                const index = galleryItems.findIndex(i => i.id === id);
                if(index > -1) galleryItems[index] = newItem;
            }

            renderItems();
            closeModal();
            await saveData(); // Persist changes
        }

        async function deleteItem(id) {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            galleryItems = galleryItems.filter(i => i.id !== id);
            renderItems();
            await saveData();
        }

        function editItem(id) {
            openModal(id);
        }

        // --- Image Upload ---

        async function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('action', 'upload_image');
                formData.append('image', input.files[0]);

                try {
                    const response = await fetch(API_URL, {
                        method: 'POST',
                        body: formData
                    });
                    
                    const text = await response.text();
                    try {
                        const result = JSON.parse(text);
                        
                        if(result.success) {
                            // Update hidden input with path
                            const pathInputId = previewId === 'beforePreview' ? 'beforePath' : 'afterPath';
                            document.getElementById(pathInputId).value = result.path;
                            
                            // Show preview
                            document.getElementById(previewId).innerHTML = `<img src="../${result.path}">`;
                        } else {
                            alert('Upload failed: ' + result.error);
                            input.value = ''; // Reset
                        }
                    } catch (e) {
                        console.error('Server response:', text);
                        alert('Server Error during upload ' + response.status + ': [' + text.substring(0, 150) + ']');
                    }
                } catch(e) {
                    console.error(e);
                    alert('Upload error: ' + e.message);
                }
            }
        }

        // Initialize
        renderItems();
    </script>
</body>
</html>
