<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $password = $_POST['password'];

    $sql = "INSERT INTO teachers (name, email, subject, password) 
            VALUES ('$name', '$email', '$subject', '$password')";
    if ($conn->query($sql)) {
        $msg = "Teacher added successfully!";
    }
}
?>

<html>
<head>
  <title>Add Teacher</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
      background-size: 400% 400%;
      animation: gradientMove 15s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @keyframes gradientMove {
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
      text-shadow: 0 0 10px #4ac29a, 0 0 20px #7873f5;
      background: linear-gradient(to right, #4ac29a, #7873f5);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from {
        text-shadow: 0 0 10px #4ac29a, 0 0 20px #7873f5;
      }
      to {
        text-shadow: 0 0 20px #4ac29a, 0 0 30px #7873f5;
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
      border-color: #4ac29a;
      outline: none;
      box-shadow: 0 0 8px rgba(74, 194, 154, 0.6);
    }

    button {
      width: 100%;
      padding: 12px;
      background: #7873f5;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #5a55e4;
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
    <h2>👨‍🏫 Add Teacher</h2>
    <form method="post">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="subject" placeholder="Subject" required>
      <input type="password" name="password" placeholder="Password" required>
      <button name="add">Add Teacher</button>
    </form>
    <?php if (isset($msg)) echo "<div class='success-message'>$msg</div>"; ?>
    <br>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
