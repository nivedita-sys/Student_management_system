<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $password = $_POST['password'];

    $sql = "INSERT INTO students (name, email, phone, course, password)
            VALUES ('$name', '$email', '$phone', '$course', '$password')";
    if ($conn->query($sql)) {
        $msg = "Student Added Successfully!";
    }
}
?>

<html>
<head>
  <title>Add Student</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .form-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.25);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      font-size: 26px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #fff;
      text-shadow: 0 0 10px #23d5ab, 0 0 20px #23a6d5;
      background: linear-gradient(to right, #23d5ab, #23a6d5);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from {
        text-shadow: 0 0 10px #23d5ab, 0 0 20px #23a6d5;
      }
      to {
        text-shadow: 0 0 20px #23d5ab, 0 0 30px #23a6d5;
      }
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #23d5ab;
      outline: none;
      box-shadow: 0 0 8px rgba(35, 213, 171, 0.6);
    }

    button {
      width: 100%;
      padding: 12px;
      background: #23a6d5;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #1a8ebc;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      color: #0072ff;
      text-decoration: none;
      font-weight: bold;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .success-message {
      margin-top: 15px;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>➕ Add Student</h2>
    <form method="post">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone" required>
      <input type="text" name="course" placeholder="Course" required>
      <input type="password" name="password" placeholder="Password" required>
      <button name="add">Add Student</button>
    </form>
    <?php if (isset($msg)) echo "<div class='success-message'>$msg</div>"; ?>
    <br>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
