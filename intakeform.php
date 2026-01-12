<?php
// Intake form page - Welcome Screen (Enhanced Branded Version)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Rani Beauty Clinic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #0F1D2C;
            --accent-gold: #F3D6BE;
            --light-bg: #FAF8F5;
            --pure-white: #FFFFFF;
            --text-dark: #2A2A2A;
            --text-gray: #B0B0B0;
            --font-primary: 'Montserrat', sans-serif;
            --font-secondary: 'Playfair Display', serif;
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
            --radius-lg: 15px;
            --radius-pill: 30px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-primary);
            background: var(--primary-navy);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pure-white);
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        /* Ethereal Background Elements */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(243, 214, 190, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(243, 214, 190, 0.1) 0%, transparent 40%),
                radial-gradient(circle at center, #1b2a3a 0%, var(--primary-navy) 100%);
        }

        /* Subtle Lotus Motif */
        .ethereal-motif {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80vh;
            height: 80vh;
            opacity: 0.03;
            pointer-events: none;
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 40px;
            width: 100%;
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-family: var(--font-secondary);
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.01em;
            color: var(--pure-white);
        }

        .tagline {
            font-family: var(--font-secondary);
            font-style: italic;
            font-size: clamp(1.2rem, 3vw, 2rem);
            font-weight: 400;
            margin-bottom: 50px;
            color: var(--accent-gold);
            letter-spacing: 0.05em;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-lg);
        }

        .highlight-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 30px;
            color: var(--accent-gold);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .description {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            font-weight: 500;
            line-height: 1.8;
            margin-bottom: 30px;
            max-width: 750px;
            margin-left: auto;
            margin-right: auto;
        }

        .details-grid {
            display: grid;
            gap: 20px;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .detail-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .detail-item span.icon {
            color: var(--accent-gold);
            font-size: 1.2rem;
        }

        .cta-container {
            margin-top: 50px;
        }

        .btn-luxe {
            background: var(--accent-gold);
            color: var(--primary-navy);
            border: none;
            padding: 18px 50px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: var(--radius-pill);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(243, 214, 190, 0.2);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-luxe:hover {
            transform: translateY(-4px);
            background: var(--pure-white);
            box-shadow: 0 12px 30px rgba(243, 214, 190, 0.3);
        }

        .powered-by {
            margin-top: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Mobile specific adjustments */
        @media (max-width: 600px) {
            .glass-card { padding: 30px 20px; }
            .container { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- Subtle Lotus Motif (SVG Background) -->
    <svg class="ethereal-motif" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M50 10C50 10 35 35 35 50C35 65 50 90 50 90C50 90 65 65 65 50C65 35 50 10 50 10Z" stroke="white" stroke-width="0.5"/>
        <path d="M10 50C10 50 35 35 50 35C65 35 90 50 90 50C90 50 65 65 50 65C35 65 10 50 10 50Z" stroke="white" stroke-width="0.5"/>
    </svg>

    <div class="container">
        <h1 class="hero-title">Welcome to Rani Beauty Clinic</h1>
        <div class="tagline">Award-Winning Medical Aesthetics</div>

        <div class="glass-card">
            <div class="highlight-text">
                <span class="icon">✨</span> Unlock Your Aura
            </div>

            <p class="description">
                You are one step away from your personalized Glow Protocol. We use advanced AI skin mapping + medical-grade expertise to tailor your perfect transformation.
            </p>

            <div class="details-grid">
                <div class="detail-item">
                    <span class="icon">🔒</span>
                    100% Confidential AI Analysis
                </div>
            </div>
        </div>

        <div class="cta-container">
            <a href="#" class="btn-luxe">Start My Glow Plan</a>
        </div>

        <div class="powered-by">
            <span>🧬</span> Aura AI + Rani Beauty GlowTech™
        </div>
    </div>

</body>
</html>
