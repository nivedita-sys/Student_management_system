<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");

$teacher = $_SESSION['teacher'];
$subject = $teacher['subject'];

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $marks = $_POST['marks'];

    $check_sql = "SELECT * FROM marks WHERE student_id='$student_id' AND subject='$subject'";
    $check_res = $conn->query($check_sql);

    if ($check_res->num_rows > 0) {
        $update_sql = "UPDATE marks SET marks='$marks' WHERE student_id='$student_id' AND subject='$subject'";
        $conn->query($update_sql);
        $message = "✅ Marks updated successfully!";
    } else {
        $insert_sql = "INSERT INTO marks (student_id, subject, marks) VALUES ('$student_id', '$subject', '$marks')";
        $message = $conn->query($insert_sql) ? "✅ Marks added successfully!" : "❌ Error: " . $conn->error;
    }
}

$students_result = $conn->query("SELECT id, name FROM students ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Give Marks</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
           background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        h2 {
            margin-bottom: 20px;
            color: #1e3c72;
        }
        select, input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            margin-top: 20px;
            background: #1e3c72;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        button:hover {
            background: #16325c;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #1e3c72;
        }
        @keyframes fadeIn {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Give Marks for: <?= htmlspecialchars($subject) ?></h2>
    <form method="post">
        <label>Select Student</label><br>
        <select name="student_id" required>
            <option value="">--Select Student--</option>
            <?php while ($student = $students_result->fetch_assoc()) { ?>
                <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
            <?php } ?>
        </select><br><br>

        <label>Enter Marks</label><br>
        <input type="number" name="marks" min="0" max="100" required><br>

        <button name="submit">Submit Marks</button>
    </form>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

    <a href="teacher_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
