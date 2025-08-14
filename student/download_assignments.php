<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$assignments = $conn->query("SELECT * FROM assignments");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Download Assignments</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #e1f5fe, #f3e5f5);
            padding: 40px;
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #6a1b9a;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px #ccc;
        }

        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
            max-width: 700px;
        }

        li {
            background: #fff;
            margin: 10px 0;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }

        li:hover {
            transform: scale(1.02);
        }

        .subject {
            font-size: 14px;
            color: #555;
            margin-left: 10px;
            font-style: italic;
        }

        a {
            background: #6a1b9a;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        a:hover {
            background: #4a148c;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s ease-in-out infinite;
        }

        .bubble.b1 { width: 100px; height: 100px; background: #f48fb1; top: 10%; left: 10%; animation-delay: 0s; }
        .bubble.b2 { width: 120px; height: 120px; background: #81d4fa; top: 60%; left: 80%; animation-delay: 3s; }
        .bubble.b3 { width: 140px; height: 140px; background: #ce93d8; top: 80%; left: 15%; animation-delay: 6s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <!-- Animated background -->
    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>

    <h2>📥 Available Assignments</h2>

    <ul>
        <?php while ($row = $assignments->fetch_assoc()): ?>
            <li>
                <div>
                    <strong><?= htmlspecialchars($row['title']) ?></strong>
                    <span class="subject">(<?= htmlspecialchars($row['subject']) ?>)</span>
                </div>
                <a href="../uploads/<?= urlencode($row['file_path']) ?>" download>Download</a>
            </li>
        <?php endwhile; ?>
    </ul>
     <a href="student_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
