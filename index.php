<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      height: 100vh;
   background: url('assets/stu.jpg') no-repeat center center/cover;

      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    h1 {
      font-size: 50px;
      color: #ffffff;
      text-shadow: 0 0 20px #000;
      margin-bottom: 10px;
      animation: zoomPulse 2.5s infinite;
      z-index: 2;
    }

    @keyframes zoomPulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    h2 {
      font-size: 20px;
      color: #f0ff72;
      margin-bottom: 40px;
      white-space: nowrap;
      overflow: hidden;
      position: relative;
      animation: scrollText 12s linear infinite;
      z-index: 2;
    }

    @keyframes scrollText {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    .container {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      justify-content: center;
      z-index: 2;
    }

    .card {
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(15px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
      width: 220px;
      transition: all 0.4s ease;
    }

    .card:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
    }

    .card img {
      width: 70px;
      height: 70px;
      margin-bottom: 20px;
      filter: drop-shadow(0 0 5px rgba(255,255,255,0.6));
    }

    .card a {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      background: #fff;
      border-radius: 10px;
      font-weight: bold;
      color: #333;
      text-decoration: none;
      transition: 0.3s;
    }

    .card a:hover {
      background: #333;
      color: #fff;
    }

    .bubbles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }

    .bubble {
      position: absolute;
      bottom: -150px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: rise 20s infinite ease-in;
    }

    .bubble:nth-child(1) { left: 10%; width: 40px; height: 40px; animation-duration: 18s; }
    .bubble:nth-child(2) { left: 20%; width: 25px; height: 25px; animation-duration: 15s; }
    .bubble:nth-child(3) { left: 35%; width: 30px; height: 30px; animation-duration: 22s; }
    .bubble:nth-child(4) { left: 50%; width: 50px; height: 50px; animation-duration: 19s; }
    .bubble:nth-child(5) { left: 70%; width: 20px; height: 20px; animation-duration: 17s; }
    .bubble:nth-child(6) { left: 85%; width: 35px; height: 35px; animation-duration: 21s; }

    @keyframes rise {
      0% { transform: translateY(0) scale(1); opacity: 0.4; }
      50% { transform: translateY(-500px) scale(1.2); opacity: 0.6; }
      100% { transform: translateY(-1000px) scale(1); opacity: 0; }
    }

    @media (max-width: 768px) {
      .card {
        width: 80%;
      }

      h1 {
        font-size: 36px;
      }

      h2 {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>

  <!-- Floating bubbles background -->
  <div class="bubbles">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
  </div>

  <h1>🎓 Student Management System</h1>


  <div class="container">
    <div class="card">
      <img src="assets/admin.png" alt="Admin Icon">
      <a href="admin/login.php">Admin Login</a>
    </div>
    <div class="card">
      <img src="assets/teacher.png" alt="Teacher Icon">
      <a href="teacher/teacher_login.php">Teacher Login</a>
    </div>
    <div class="card">
      <img src="assets/book.png" alt="Student Icon">
      <a href="student/student_login.php">Student Login</a>
    </div>
  </div>

</body>
</html>
