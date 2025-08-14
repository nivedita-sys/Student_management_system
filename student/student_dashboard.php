<?php
session_start();
if (!isset($_SESSION['student'])) header("Location: student_login.php");

$student = $_SESSION['student'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Dashboard</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

  /* Background circles animation */
  body, html {
    margin: 0; padding: 0; height: 100%;
    font-family: 'Nunito', sans-serif;
    background: #e0f7fa;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* Circles */
  .circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(0, 150, 136, 0.15);
    animation: floatUp 15s linear infinite;
    opacity: 0.7;
  }
  .circle.small {
    width: 60px;
    height: 60px;
    left: 15%;
    animation-duration: 12s;
  }
  .circle.medium {
    width: 100px;
    height: 100px;
    left: 50%;
    animation-duration: 18s;
  }
  .circle.large {
    width: 150px;
    height: 150px;
    left: 75%;
    animation-duration: 20s;
  }

  @keyframes floatUp {
    0% {
      bottom: -100px;
      opacity: 0.7;
      transform: translateX(0);
    }
    50% {
      opacity: 0.4;
      transform: translateX(20px);
    }
    100% {
      bottom: 110%;
      opacity: 0;
      transform: translateX(0);
    }
  }

  .dashboard-container {
    position: relative;
    background: #fff;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    width: 350px;
    z-index: 10;
    text-align: center;
  }

  h2 {
    font-weight: 700;
    color: #00796b;
    margin-bottom: 30px;
  }

  ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  ul li {
    margin: 18px 0;
  }

  ul li a {
    display: block;
    text-decoration: none;
    background: #00796b;
    color: #fff;
    padding: 14px 0;
    border-radius: 10px;
    font-weight: 600;
    font-size: 17px;
    transition: background 0.3s ease;
  }

  ul li a:hover {
    background: #004d40;
  }

  ul li a.logout {
    background: #d32f2f;
  }

  ul li a.logout:hover {
    background: #9a0007;
  }

  @media (max-width: 400px) {
    .dashboard-container {
      width: 90%;
      padding: 30px 20px;
    }
  }
</style>
</head>
<body>
  <!-- Background circles -->
  <div class="circle small"></div>
  <div class="circle medium"></div>
  <div class="circle large"></div>

  <div class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($student['name']) ?></h2>
    <ul>
      <li><a href="student_view_marks.php">📄 View Marks</a></li>
      <li><a href="student_progress_chart.php">📊 View Progress</a></li>
      <li><a href="student_timetable.php">🗓️ View Exam Timetable</a></li>
      <li><a href="submit_assignment.php">📤 Submit Assignment</a></li>
      <li><a href="download_assignments.php">📥 Download Assignments</a></li>
      <li><a href="student_logout.php" class="logout">🚪 Logout</a></li>
    </ul>
  </div>
</body>
</html>
