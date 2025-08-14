<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['student'])) {
    die("Student not logged in.");
}

$student_id = $_SESSION['student']['id'];

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $filename = basename($_FILES['file']['name']);
    $target_path = "../submissions/" . $filename;

    // Ensure submissions folder exists
    if (!is_dir("../submissions")) {
        mkdir("../submissions", 0777, true);
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $stmt = $conn->prepare("INSERT INTO submitted_assignments (student_id, assignment_title, file_path) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iss", $student_id, $title, $filename);
            if ($stmt->execute()) {
                $msg = "✅ Assignment submitted successfully!";
            } else {
                $msg = "❌ DB Insert failed: " . $stmt->error;
            }
        } else {
            $msg = "❌ Prepare failed: " . $conn->error;
        }
    } else {
        $msg = "❌ Failed to upload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Assignment</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f9fbe7, #e1f5fe);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            min-height: 100vh;
            position: relative;
        }

        h2 {
            color: #2e7d32;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px #ccc;
        }

        form {
            background: #ffffffd9;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            margin: 12px 0;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #bbb;
        }

        button {
            background: #388e3c;
            color: white;
            padding: 12px 20px;
            border: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: 0.3s ease;
        }

        button:hover {
            background: #2e7d32;
        }

        p {
            margin-top: 20px;
            font-weight: bold;
            color: #2e7d32;
            font-size: 16px;
        }

        a {
            margin-top: 25px;
            display: inline-block;
            color: #1e88e5;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #0d47a1;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s ease-in-out infinite;
        }

        .bubble.b1 { width: 120px; height: 120px; background: #81c784; top: 10%; left: 10%; animation-delay: 0s; }
        .bubble.b2 { width: 100px; height: 100px; background: #4dd0e1; top: 60%; left: 70%; animation-delay: 3s; }
        .bubble.b3 { width: 140px; height: 140px; background: #ba68c8; top: 80%; left: 20%; animation-delay: 6s; }

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

    <h2>📤 Submit Your Assignment</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Assignment Title" required>
        <input type="file" name="file" required>
        <button name="submit">Submit</button>
    </form>

    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>

    <a href="student_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
