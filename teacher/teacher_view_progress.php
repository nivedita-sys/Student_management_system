<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");

$teacher = $_SESSION['teacher'];
$subject = $teacher['subject'];

$sql = "SELECT students.name, marks.marks FROM marks 
        JOIN students ON marks.student_id = students.id 
        WHERE marks.subject='$subject'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student Progress</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
             background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 900px;
            text-align: center;
            animation: fadeIn 1s ease;
        }
        h2 {
            color: #1e3c72;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #1e3c72;
            color: white;
        }
        .progress-bar-container {
            background-color: #eee;
            border-radius: 5px;
            height: 20px;
            width: 100%;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 5px;
            background-color: #4CAF50;
            transition: width 0.8s ease;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            background: #1e3c72;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }
        a:hover {
            background: #16325c;
        }
        @keyframes fadeIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Student Progress for Subject: <?= htmlspecialchars($subject) ?></h2>

    <table>
        <tr>
            <th>Student Name</th>
            <th>Marks</th>
            <th>Progress</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { 
            $percentage = intval($row['marks']);
        ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $percentage ?>%</td>
            <td>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: <?= $percentage ?>%;"></div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="teacher_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
