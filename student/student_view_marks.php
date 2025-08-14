<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['student'])) header("Location: student_login.php");

$student_id = $_SESSION['student']['id'];
$result = $conn->query("SELECT * FROM marks WHERE student_id=$student_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Marks</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }

    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #e1f5fe, #fce4ec);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    h2 {
      color: #00695c;
      margin-bottom: 30px;
      font-size: 32px;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 600px;
      background: #ffffffcc;
      backdrop-filter: blur(5px);
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 15px;
      text-align: center;
      font-size: 18px;
    }

    th {
      background-color: #00897b;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f1f8e9;
    }

    tr:hover {
      background-color: #dcedc8;
      transition: 0.3s ease;
    }

    a {
      display: inline-block;
      margin-top: 25px;
      padding: 12px 25px;
      background: #00796b;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    a:hover {
      background: #004d40;
    }

    /* Animated colorful background bubbles */
    .circle {
      position: absolute;
      border-radius: 50%;
      opacity: 0.15;
      animation: float 10s infinite ease-in-out;
    }

    .circle.c1 { width: 120px; height: 120px; background: #f06292; top: 10%; left: 10%; animation-delay: 0s; }
    .circle.c2 { width: 100px; height: 100px; background: #64b5f6; top: 20%; left: 70%; animation-delay: 2s; }
    .circle.c3 { width: 90px; height: 90px; background: #81c784; top: 60%; left: 20%; animation-delay: 4s; }
    .circle.c4 { width: 110px; height: 110px; background: #ba68c8; top: 75%; left: 80%; animation-delay: 6s; }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-25px); }
    }
  </style>
</head>
<body>
  <!-- Animated background circles -->
  <div class="circle c1"></div>
  <div class="circle c2"></div>
  <div class="circle c3"></div>
  <div class="circle c4"></div>

  <h2>Your Marks</h2>
  <table>
    <tr><th>Subject</th><th>Marks</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row['subject']) ?></td>
      <td><?= htmlspecialchars($row['marks']) ?></td>
    </tr>
    <?php } ?>
  </table>

  <a href="student_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
