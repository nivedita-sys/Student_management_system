<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['publish'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $details = $_POST['details'];

    $conn->query("INSERT INTO timetable (exam_title, date, details) VALUES ('$title', '$date', '$details')");
    $msg = "✅ Timetable published successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Publish Timetable</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(-45deg, #ff9966, #ff5e62, #8f94fb, #4e54c8);
            background-size: 400% 400%;
            animation: gradientFlow 12s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        @keyframes gradientFlow {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .card h2 {
            margin-bottom: 25px;
            font-size: 28px;
            color: #00ffd5;
            text-shadow: 2px 2px 4px #000;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.3);
        }

        input::placeholder, textarea::placeholder {
            color: #ddd;
        }

        button {
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #00ffd5;
            color: #000;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #fff;
            color: #000;
            box-shadow: 0 0 10px #00ffd5, 0 0 20px #00ffd5;
        }

        .msg {
            margin-top: 15px;
            font-weight: bold;
            color: #00ff88;
        }

        .back-link {
            display: block;
            margin-top: 25px;
            text-decoration: none;
            color: #00ffd5;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #fff;
            text-shadow: 0 0 10px #00ffd5;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>📅 Publish Exam Timetable</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Exam Title" required>
            <input type="date" name="date" required>
            <textarea name="details" placeholder="Enter exam details here..." rows="5" required></textarea>
            <button name="publish">Publish</button>
        </form>
        <?php if (isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>
