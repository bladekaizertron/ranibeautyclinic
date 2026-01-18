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

    <link rel="stylesheet" href="style.css?v=2" />
</head>
    <body>
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <i class="fa fa-bars"></i>
        </button>
        <div class="dash-wrapper">
            <aside class="sidebar" id="sidebar">
                <div class="sidebar-brand">
                    <img src="../assets/images/logo.png" alt="Rani Beauty Clinic Logo" class="sidebar-logo" />
                </div>

                <nav class="sidebar-nav">
                    <a href="dashboard.php" class="sidebar-link active"><i class="fa fa-home"></i> Dashboard</a>
                    
                    <!-- Booking Page with collapsible submenu -->
                    <div class="sidebar-dropdown">
                        <a href="#" class="sidebar-link sidebar-dropdown-toggle" id="bookingPageToggle">
                            <i class="fa fa-globe"></i> Booking Page
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>
                        <div class="sidebar-submenu" id="bookingPageSubmenu">
                            <a href="edit_media.php" class="sidebar-sublink"><i class="fa fa-image"></i> Media</a>
                            <a href="edit_content.php" class="sidebar-sublink"><i class="fa fa-file-alt"></i> Content</a>
                        </div>
                    </div>
                    
                    <a href="../CRM/admin/dashboard.php" class="sidebar-link"><i class="fa fa-sign-out-alt"></i> Go back to MedSpa CRM </a>
                </nav>
            </aside>

            <div class="dash-content">
                <header class="dash-header">
                    <h2>Welcome <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Admin'; ?></h2>
                </header>

                <main class="dash-main">
                    <!-- Quick links -->

                    <section class="preview-wrapper">
                        <div class="preview-header">
                            <h3>Homepage Preview</h3>
                            <a href="../index.html" target="_blank" class="btn-secondary small">Open in new tab</a>
                        </div>
                        <iframe src="../index.html" title="Site Preview" class="site-preview" loading="lazy"></iframe>
                    </section>
                </main>
            </div>
        </div>

        <!-- Font Awesome for icons -->
        <script src="https://kit.fontawesome.com/25e8e2a0e0.js" crossorigin="anonymous"></script>
        <script>
            // Mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const menuToggle = document.getElementById('mobileMenuToggle');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                overlay.style.cssText = 'position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 998; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease;';
                document.body.appendChild(overlay);

                function openMenu() {
                    sidebar.classList.add('open');
                    document.body.classList.add('sidebar-open');
                    overlay.style.opacity = '1';
                    overlay.style.visibility = 'visible';
                }

                function closeMenu() {
                    sidebar.classList.remove('open');
                    document.body.classList.remove('sidebar-open');
                    overlay.style.opacity = '0';
                    overlay.style.visibility = 'hidden';
                }

                if (menuToggle && sidebar) {
                    menuToggle.addEventListener('click', function() {
                        if (sidebar.classList.contains('open')) {
                            closeMenu();
                        } else {
                            openMenu();
                        }
                    });

                    overlay.addEventListener('click', closeMenu);

                    // Close menu when clicking a sidebar link on mobile
                    const sidebarLinks = sidebar.querySelectorAll('.sidebar-link');
                    sidebarLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            if (window.innerWidth <= 768) {
                                closeMenu();
                            }
                        });
                    });
                }

                // Booking Page dropdown toggle
                const bookingPageToggle = document.getElementById('bookingPageToggle');
                const bookingPageSubmenu = document.getElementById('bookingPageSubmenu');
                
                if (bookingPageToggle && bookingPageSubmenu) {
                    bookingPageToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        const isOpen = bookingPageSubmenu.classList.contains('open');
                        
                        if (isOpen) {
                            bookingPageSubmenu.classList.remove('open');
                            this.classList.remove('active');
                        } else {
                            bookingPageSubmenu.classList.add('open');
                            this.classList.add('active');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
