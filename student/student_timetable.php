<?php
session_start();
include '../includes/db.php';

// Only allow logged-in students
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

// Fetch all timetables, latest first
$sql = "SELECT * FROM timetable ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Timetable</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #fce4ec, #e3f2fd);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        h2 {
            color: #283593;
            font-size: 32px;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        ul {
            width: 90%;
            max-width: 800px;
            list-style: none;
            background: rgba(255,255,255,0.8);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        li {
            padding: 15px;
            margin-bottom: 15px;
            border-left: 6px solid #3f51b5;
            background: #fafafa;
            border-radius: 8px;
        }

        li strong {
            color: #1a237e;
            font-size: 18px;
        }

        li em {
            color: #00796b;
            font-style: normal;
        }

        p {
            color: #424242;
            margin-top: 6px;
        }

        a {
            margin-top: 30px;
            padding: 12px 25px;
            background: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        a:hover {
            background: #004d40;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }

        .circle.c1 { width: 120px; height: 120px; background: #ff8a65; top: 10%; left: 8%; animation-delay: 0s; }
        .circle.c2 { width: 100px; height: 100px; background: #4dd0e1; top: 35%; left: 75%; animation-delay: 2s; }
        .circle.c3 { width: 140px; height: 140px; background: #ba68c8; top: 70%; left: 15%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
    </style>
</head>
<body>
    <!-- Animated background bubbles -->
    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>

    <h2>📅 Exam Timetable</h2>

    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while($row = $result->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($row['exam_title']) ?></strong><br>
                    <em>Date: <?= date("d M Y", strtotime($row['date'])) ?></em><br>
                    <p><?= nl2br(htmlspecialchars($row['details'])) ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No exam timetable published yet.</p>
    <?php endif; ?>

    <a href="student_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
