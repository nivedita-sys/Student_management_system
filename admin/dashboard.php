<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

  /* Base Reset */
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }

  body, html {
    height: 100%;
    font-family: 'Poppins', sans-serif;
    background: #121212;
    background-image: radial-gradient(circle at center, #272727, #121212 80%);
    overflow-x: hidden;
    color: #222;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 60px 20px 80px;
  }

  /* Animate subtle moving dots on background */
  body::before {
    content: "";
    position: fixed;
    top: -200px; left: -200px; right: -200px; bottom: -200px;
    background: radial-gradient(circle at 10% 20%, #00bcd4aa 2px, transparent 3px),
                radial-gradient(circle at 30% 50%, #ff5722aa 2px, transparent 3px),
                radial-gradient(circle at 60% 80%, #8bc34aaa 2px, transparent 3px),
                radial-gradient(circle at 80% 30%, #ffc107aa 2px, transparent 3px);
    background-repeat: repeat;
    background-size: 400px 400px;
    animation: moveBackground 30s linear infinite;
    z-index: 0;
  }

  @keyframes moveBackground {
    0% {background-position: 0 0, 0 0, 0 0, 0 0;}
    100% {background-position: 400px 400px, 400px 400px, 400px 400px, 400px 400px;}
  }

  h1 {
    position: relative;
    font-size: 3rem;
    color: #eee;
    margin-bottom: 50px;
    z-index: 1;
    text-shadow: 0 0 10px #00bcd4aa;
  }

  .container {
    width: 100%;
    max-width: 1100px;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 25px 35px;
    z-index: 1;
  }

  /* The first 4 options in one line */
  .container > a {
    background: #fafafa;
    color: #121212;
    box-shadow: 0 8px 15px rgb(0 0 0 / 0.15);
    border-radius: 18px;
    padding: 25px 35px;
    flex: 1 1 20%; /* flex basis ~20% for about 4 in a row */
    min-width: 180px;
    font-weight: 700;
    font-size: 1.2rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    user-select: none;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .container > a:hover {
    box-shadow: 0 15px 30px rgb(0 188 212 / 0.4);
    transform: translateY(-6px);
    color: #00bcd4;
  }

  /* Center the 5th option in next line */
  .container > a:nth-child(5) {
    flex: 1 1 100%;
    max-width: 220px;
    margin-left: auto;
    margin-right: auto;
  }

  /* Logout button separate */
  .logout {
    margin-top: 60px;
    background: #e63946;
    color: #fff;
    padding: 18px 0;
    width: 220px;
    font-weight: 800;
    font-size: 1.3rem;
    border-radius: 40px;
    box-shadow: 0 12px 30px #e63946cc;
    text-align: center;
    user-select: none;
    transition: all 0.3s ease;
    text-decoration: none;
    z-index: 1;
  }

  .logout:hover {
    background: #d62828;
    box-shadow: 0 16px 40px #d62828ee;
    transform: translateY(-5px);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .container > a {
      flex: 1 1 40%;
      min-width: 160px;
    }

    .container > a:nth-child(5) {
      flex: 1 1 100%;
      max-width: 220px;
      margin-left: auto;
      margin-right: auto;
    }
  }

  @media (max-width: 480px) {
    h1 {
      font-size: 2.3rem;
      text-align: center;
    }
    .container > a {
      flex: 1 1 100%;
      max-width: 100%;
      min-width: unset;
    }
    .container > a:nth-child(5) {
      max-width: 100%;
      margin: 0 auto;
    }
    .logout {
      width: 100%;
      max-width: 320px;
    }
  }
</style>
</head>
<body>
  <h1>Welcome, Admin</h1>
  <div class="container">
    <a href="add_student.php" title="Add Student">Add Student</a>
    <a href="add_teacher.php" title="Add Teacher">Add Teacher</a>
    <a href="manage_students.php" title="Manage Students">Manage Students</a>
    <a href="manage_teachers.php" title="Manage Teachers">Manage Teachers</a>
    <a href="publish_timetable.php" title="Publish Timetable">Publish Timetable</a>
  </div>

  <a href="logout.php" class="logout" title="Logout">Logout</a>
</body>
</html>
