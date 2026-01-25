<?php
// Enhanced Interactive Multi-Step Intake Form for Rani Beauty Clinic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intake Form - Rani Beauty Clinic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #0F1D2C;
            --accent-gold: #F3D6BE;
            --light-bg: #FAF8F5;
            --pure-white: #FFFFFF;
            --text-dark: #2A2A2A;
            --text-gray: rgba(255, 255, 255, 0.6);
            --font-primary: 'Montserrat', sans-serif;
            --font-secondary: 'Playfair Display', serif;
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
            --radius-lg: 20px;
            --radius-pill: 30px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
                radial-gradient(circle at 15% 20%, rgba(243, 214, 190, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 85% 80%, rgba(243, 214, 190, 0.08) 0%, transparent 35%),
                radial-gradient(circle at center, #1b2a3a 0%, var(--primary-navy) 100%);
        }

        /* Progress Bar */
        .progress-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1000;
        }
        .progress-bar {
            height: 100%;
            background: var(--accent-gold);
            width: 0%;
            transition: width 0.5s ease;
            box-shadow: 0 0 10px var(--accent-gold);
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 800px;
            width: 90%;
            padding: 20px;
            margin: auto;
        }

        /* Screens */
        .screen {
            display: none;
            animation: slideUp 0.6s ease forwards;
        }
        .screen.active {
            display: block;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-30px); }
        }

        /* Typography */
        h1.hero-title {
            font-family: var(--font-secondary);
            font-size: clamp(2rem, 6vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--pure-white);
        }
        .tagline {
            font-family: var(--font-secondary);
            font-style: italic;
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            color: var(--accent-gold);
            margin-bottom: 40px;
        }

        .question-label {
            font-family: var(--font-secondary);
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            font-weight: 600;
            margin-bottom: 30px;
            line-height: 1.3;
            color: var(--pure-white);
        }

        /* Inputs */
        input[type="text"], input[type="email"], input[type="date"], input[type="tel"], input[type="number"] {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding: 15px 0;
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            color: var(--accent-gold);
            font-family: var(--font-primary);
            outline: none;
            transition: var(--transition);
        }
        input:focus {
            border-bottom-color: var(--accent-gold);
        }

        /* Option Buttons (Multi-select / Single-select) */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .option-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 1rem;
            text-align: left;
        }
        .option-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-gold);
        }
        .option-card.selected {
            background: var(--accent-gold);
            color: var(--primary-navy);
            border-color: var(--accent-gold);
            font-weight: 700;
        }
        .option-card span.letter {
            width: 24px;
            height: 24px;
            border: 1px solid currentColor;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            opacity: 0.6;
        }

        /* File Upload */
        .upload-area {
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-lg);
            padding: 40px;
            cursor: pointer;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.02);
            position: relative;
        }
        .upload-area:hover {
            border-color: var(--accent-gold);
            background: rgba(255, 255, 255, 0.05);
        }
        .upload-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--accent-gold);
        }
        #file-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
            object-fit: contain;
        }

        /* Buttons */
        .btn-luxe {
            background: var(--accent-gold);
            color: var(--primary-navy);
            border: none;
            padding: 16px 45px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: var(--radius-pill);
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            box-shadow: 0 4px 15px rgba(243, 214, 190, 0.2);
            margin-top: 30px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-luxe:hover {
            transform: translateY(-3px);
            background: var(--pure-white);
            box-shadow: 0 10px 25px rgba(243, 214, 190, 0.3);
        }

        /* Back Button */
        .btn-back {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--pure-white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 100;
        }
        .btn-back:hover {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
        }

        /* Keyboard Tip */
        .keyboard-tip {
            margin-top: 20px;
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 500;
        }
        .keyboard-tip kbd {
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Particles Canvas */
        #particles-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        @media (max-width: 600px) {
            .options-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Particles Canvas -->
    <canvas id="particles-canvas"></canvas>

    <div class="progress-container">
        <div class="progress-bar" id="progress-bar"></div>
    </div>

    <button class="btn-back" id="btn-back" style="display: none;" onclick="prevStep()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </button>

    <div class="container" id="app">
        <!-- Welcome Screen -->
        <div class="screen active" id="welcome-screen">
            <h1 class="hero-title">Rani Beauty Clinic</h1>
            <div class="tagline">Award-Winning Medical Aesthetics</div>
            <p style="font-size: 1.2rem; line-height: 1.6; opacity: 0.9; margin-bottom: 40px;">
                Your journey to a heavenly glow begins here. Please complete our pre-consultation questionnaire.
            </p>
            <button class="btn-luxe" onclick="startForm()">
                Start My Glow Plan
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>

        <!-- Question Screen Template -->
        <div class="screen" id="question-screen">
            <div id="question-content">
                <label class="question-label" id="question-text"></label>
                <div id="input-container"></div>
            </div>
            <div style="margin-top: 40px;">
                <button class="btn-luxe" id="btn-ok" onclick="nextStep()">
                    OK
                </button>
                <div class="keyboard-tip">Press <kbd>Enter</kbd> to continue</div>
            </div>
        </div>

        <!-- Thank You Screen -->
        <div class="screen" id="thank-you-screen">
            <div style="font-size: 5rem; color: var(--accent-gold); margin-bottom: 30px;">✨</div>
            <h1 class="hero-title">Thank You</h1>
            <p style="font-size: 1.2rem; line-height: 1.8; opacity: 0.9; margin: 20px auto;">
                Thank you for taking the time to complete our pre-consultation questionnaire.
            </p>
            <p style="font-size: 1.2rem; line-height: 1.8; opacity: 0.9;">
                We look forward to welcoming you at Rani Beauty Clinic and creating a custom treatment plan that brings your skincare goals to life.
            </p>
            <div style="margin-top: 40px;">
                <a href="index.html" class="btn-luxe">Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        const progressBar = document.getElementById('progress-bar');
        const btnBack = document.getElementById('btn-back');
        const qText = document.getElementById('question-text');
        const inputContainer = document.getElementById('input-container');
        const btnOk = document.getElementById('btn-ok');
        const screens = {
            welcome: document.getElementById('welcome-screen'),
            question: document.getElementById('question-screen'),
            thankyou: document.getElementById('thank-you-screen')
        };

        let currentStep = -1;
        let answers = {};

        const questions = [
            { id: 'name', text: '1. What is your full name?', type: 'text' },
            { id: 'dob', text: '2. Date of Birth', type: 'date' },
            { id: 'email', text: '3. Please provide your email.', type: 'email' },
            { id: 'phone', text: '4. Phone Number', type: 'tel' },
            { id: 'contact_pref', text: '5. How would you prefer we contact you?', type: 'multi-select', options: ['Email', 'Text', 'Phone'] },
            { id: 'referral', text: '6. How did you hear about us?', type: 'multi-select', options: ['Google', 'Tiktok', 'Instagram', 'Referral', 'Other'] },
            { id: 'aura_scan', text: '7. Please upload your Aura Skin Scan or a selfie here.', type: 'file' },
            { id: 'concerns', text: '8. What are your top skin concerns?', type: 'multi-select', options: ['Hyperpigmentation', 'Acne', 'Fine Lines', 'Texture', 'Laxity or loose skin', 'Dryness', 'Hair Removal', 'Acne Scars', 'Scars', 'Undereye darkness', 'Rosacea'] },
            { id: 'areas', text: '9. What areas would you like to improve?*', type: 'multi-select', options: ['Face', 'Neck', 'Hands', 'Body', 'Underarms', 'Back', 'Other'] },
            { id: 'treatments', text: '10. What treatments are you most interested in?', type: 'multi-select', options: ['Laser Hair Removal', 'Hydrafacial', 'Injectables', 'Laser Facials', 'Botox', 'Peels', 'Hormones', 'Sofwave', 'Radiofrequency Microneedling', 'Skin Boosters'] },
            { id: 'special_event', text: '11. Are you preparing for a special event?', type: 'single-select', options: ['Yes', 'No'] },
            { id: 'recent_treatments', text: '12. Have you had any cosmetic treatments, injectables or surgeries in the last 12 months?', type: 'single-select', options: ['Yes', 'No'] },
            { id: 'medical_cond_choice', text: '13. Do you have any medical conditions we should be aware of?', type: 'single-select', options: ['Yes', 'No'] },
            { id: 'medical_cond_text', text: '14. Which medical conditions should we be aware of?', type: 'text' },
            { id: 'sensitivities', text: '15. Do you have any known skin sensitivities or allergies?', type: 'single-select', options: ['Yes', 'No'] },
            { id: 'habits', text: '16. Do you smoke or consume alcohol?', type: 'multi-select', options: ['Smoke', 'Drink', 'Neither'] },
            { id: 'water', text: '17. How much water do you drink daily?', type: 'single-select', options: ['Less than 1 liter', '1-2 liters', 'More than 2 liters'] },
            { id: 'skin_type', text: '18. How would you describe your skin type?', type: 'multi-select', options: ['Oily', 'Dry', 'Combination', 'Sensitive'] },
            { id: 'best_days', text: '19. Which days are best for your appointments?', type: 'multi-select', options: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] },
            { id: 'best_time', text: '20. What time of day do you prefer for your appointments?', type: 'multi-select', options: ['Morning', 'Afternoon', 'Evening'] },
            { id: 'routine_pics', text: '21. Please upload pictures of your day and night time skin care routine.', type: 'file', isSubmit: true }
        ];

        function startForm() {
            currentStep = 0;
            renderStep();
        }

        function renderStep() {
            const q = questions[currentStep];
            screens.welcome.classList.remove('active');
            screens.question.classList.add('active');
            btnBack.style.display = 'flex';
            qText.innerText = q.text;
            inputContainer.innerHTML = '';
            
            if (['text', 'email', 'tel', 'date'].includes(q.type)) {
                const input = document.createElement('input');
                input.type = q.type;
                input.id = 'current-input';
                input.value = answers[q.id] || '';
                inputContainer.appendChild(input);
                setTimeout(() => input.focus(), 100);
            } else if (q.type === 'multi-select' || q.type === 'single-select') {
                const grid = document.createElement('div');
                grid.className = 'options-grid';
                let selected = answers[q.id] || (q.type === 'multi-select' ? [] : '');
                
                q.options.forEach((opt, i) => {
                    const card = document.createElement('div');
                    card.className = 'option-card' + (q.type === 'multi-select' ? (selected.includes(opt) ? ' selected' : '') : (selected === opt ? ' selected' : ''));
                    card.innerHTML = `<span class="letter">${String.fromCharCode(65+i)}</span> ${opt}`;
                    card.onclick = () => {
                        if (q.type === 'single-select') {
                            grid.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
                            card.classList.add('selected');
                            answers[q.id] = opt;
                            // setTimeout(nextStep, 300); // Auto-advance disabled
                        } else {
                            card.classList.toggle('selected');
                            if (card.classList.contains('selected')) selected.push(opt);
                            else selected = selected.filter(v => v !== opt);
                            answers[q.id] = selected;
                        }
                    };
                    grid.appendChild(card);
                });
                inputContainer.appendChild(grid);
            } else if (q.type === 'file') {
                const area = document.createElement('div');
                area.className = 'upload-area';
                area.innerHTML = `<div class="upload-icon">📸</div><p>Click to upload picture</p><input type="file" id="current-input" style="display:none"><img id="file-preview">`;
                const fileInput = area.querySelector('input');
                const preview = area.querySelector('#file-preview');
                area.onclick = () => fileInput.click();
                fileInput.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (re) => { preview.src = re.target.result; preview.style.display = 'block'; area.querySelector('p').innerText = file.name; answers[q.id] = file; };
                        reader.readAsDataURL(file);
                    }
                };
                inputContainer.appendChild(area);
            }
            btnOk.innerText = q.isSubmit ? 'Submit' : 'OK';
            updateProgress();
        }

        function nextStep() {
            const q = questions[currentStep];
            const input = document.getElementById('current-input');
            if (input && ['text', 'email', 'tel', 'date'].includes(q.type)) answers[q.id] = input.value;
            
            // Conditional logic for medical conditions
            if (q.id === 'medical_cond_choice' && answers['medical_cond_choice'] === 'No') {
                currentStep += 2; // Jump over step 14
            } else if (currentStep < questions.length - 1) {
                currentStep++;
            } else {
                finishForm();
                return;
            }
            renderStep();
        }

        function prevStep() {
            if (currentStep > 0) {
                // Conditional logic for back button
                if (questions[currentStep].id === 'sensitivities' && answers['medical_cond_choice'] === 'No') {
                    currentStep -= 2;
                } else {
                    currentStep--;
                }
                renderStep();
            } else {
                currentStep = -1;
                screens.question.classList.remove('active');
                screens.welcome.classList.add('active');
                btnBack.style.display = 'none';
                progressBar.style.width = '0%';
            }
        }

        function finishForm() {
            // Show loading state
            btnOk.disabled = true;
            btnOk.innerText = 'Submitting...';

            const formData = new FormData();
            for (const key in answers) {
                if (answers[key] instanceof File) {
                    formData.append(key, answers[key]);
                } else if (Array.isArray(answers[key])) {
                    formData.append(key, answers[key].join(', '));
                } else {
                    formData.append(key, answers[key]);
                }
            }

            fetch('CRM/admin/api/api_submit_intake.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    screens.question.classList.remove('active');
                    screens.thankyou.classList.add('active');
                    btnBack.style.display = 'none';
                    progressBar.style.width = '100%';
                } else {
                    alert('Submission failed: ' + data.message);
                    btnOk.disabled = false;
                    btnOk.innerText = 'Submit';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                btnOk.disabled = false;
                btnOk.innerText = 'Submit';
            });
        }

        function updateProgress() { progressBar.style.width = ((currentStep + 1) / questions.length) * 100 + '%'; }

        document.addEventListener('keydown', (e) => { if (e.key === 'Enter' && currentStep >= 0) nextStep(); });

        // Particles Effect
        (function() {
            const canvas = document.getElementById('particles-canvas');
            const ctx = canvas.getContext('2d');
            let particles = [];
            let animationId;

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 3 + 1;
                    this.speedX = Math.random() * 0.5 - 0.25;
                    this.speedY = Math.random() * 0.5 - 0.25;
                    this.opacity = Math.random() * 0.5 + 0.2;
                }

                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;

                    // Wrap around screen
                    if (this.x > canvas.width) this.x = 0;
                    if (this.x < 0) this.x = canvas.width;
                    if (this.y > canvas.height) this.y = 0;
                    if (this.y < 0) this.y = canvas.height;
                }

                draw() {
                    ctx.fillStyle = `rgba(243, 214, 190, ${this.opacity})`;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            function init() {
                resizeCanvas();
                particles = [];
                const particleCount = Math.floor((canvas.width * canvas.height) / 15000);
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                particles.forEach(particle => {
                    particle.update();
                    particle.draw();
                });

                // Draw connections
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance < 120) {
                            ctx.strokeStyle = `rgba(243, 214, 190, ${0.15 * (1 - distance / 120)})`;
                            ctx.lineWidth = 1;
                            ctx.beginPath();
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.stroke();
                        }
                    }
                }

                animationId = requestAnimationFrame(animate);
            }

            window.addEventListener('resize', () => {
                resizeCanvas();
                init();
            });

            init();
            animate();
        })();
    </script>
</body>
</html>
