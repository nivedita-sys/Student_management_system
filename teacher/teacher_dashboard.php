<?php
session_start();
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");
$teacher = $_SESSION['teacher'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Poppins&display=swap');

        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #0f2027;
            overflow: hidden;
            position: relative;
            color: white;
        }

        canvas#particles {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .dashboard-container {
            position: relative;
            z-index: 2;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 36px;
            margin-bottom: 40px;
            text-shadow: 0 0 10px cyan, 0 0 20px cyan;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 18px;
            max-width: 90vw;
        }

        a.dashboard-btn {
            padding: 15px 28px;
            font-size: 17px;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #11998e, #38ef7d);
            box-shadow: 0 0 12px rgba(56, 239, 125, 0.6);
            transition: 0.3s;
            min-width: 220px;
        }

        a.dashboard-btn:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #38ef7d, #11998e);
            box-shadow: 0 0 18px rgba(56, 239, 125, 0.9);
        }

        .logout-wrapper {
            margin-top: 30px;
        }

        a.logout-btn {
            background: linear-gradient(135deg, #e53935, #e35d5b);
            box-shadow: 0 0 12px rgba(227, 93, 91, 0.6);
        }

        a.logout-btn:hover {
            background: linear-gradient(135deg, #e35d5b, #e53935);
            box-shadow: 0 0 18px rgba(227, 93, 91, 0.9);
        }

        @media (max-width: 600px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<canvas id="particles"></canvas>

<div class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($teacher['name']) ?> 👩‍🏫</h2>

    <div class="button-container">
        <a href="teacher_give_marks.php" class="dashboard-btn">📝 Give Marks</a>
        <a href="teacher_view_progress.php" class="dashboard-btn">📊 My Student Progress</a>
        <a href="teacher_view_all_marks.php" class="dashboard-btn">📈 View All Subjects</a>
        <a href="upload_assignment.php" class="dashboard-btn">📤 Upload Assignment</a>
        <a href="view_submitted_assignments.php" class="dashboard-btn">📥 View Submissions</a>
    </div>

    <div class="logout-wrapper">
        <a href="teacher_logout.php" class="dashboard-btn logout-btn">🚪 Logout</a>
    </div>
</div>

<script>
    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');
    let particlesArray = [];

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 1;
            this.speedX = Math.random() * 1 - 0.5;
            this.speedY = Math.random() * 1 - 0.5;
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
            if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
        }

        draw() {
            ctx.fillStyle = 'rgba(255,255,255,0.8)';
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function init() {
        particlesArray = [];
        for (let i = 0; i < 100; i++) {
            particlesArray.push(new Particle());
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let particle of particlesArray) {
            particle.update();
            particle.draw();
        }
        requestAnimationFrame(animate);
    }

    init();
    animate();

    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        init();
    });
</script>
</body>
</html>
