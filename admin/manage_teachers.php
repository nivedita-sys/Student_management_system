<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM teachers WHERE id=$id");
}

// Fetch teachers
$result = $conn->query("SELECT * FROM teachers");
if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Teachers</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(-45deg, rgb(84, 196, 244), rgb(226, 89, 206), rgb(252, 143, 76), rgb(113, 14, 14));
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
            color: #fff;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h2 {
            text-align: center;
            color: #ffffff;
            font-size: 34px;
            margin-top: 30px;
            text-shadow: 2px 2px 6px #000000a6;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            border-radius: 8px;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
            border: 1px solid #ffffff33;
            color: #f0f0f0;
            font-size: 16px;
        }

        th {
            background-color: rgba(255, 255, 255, 0.08);
            color: #00ffd5;
            font-weight: bold;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        td a {
            color: #ff5b5b;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            color: #ffffff;
            text-shadow: 0 0 6px #ff4d4d;
        }

        .back-link {
            display: block;
            text-align: center;
            margin: 25px auto;
            font-size: 18px;
            color: #00ffd5;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #00ffd5;
        }
    </style>
</head>
<body>
    <h2>Manage Teachers</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['subject'] ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this teacher?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</body>
</html>
