<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $file = $_FILES['assignment']['name'];
    $tmp = $_FILES['assignment']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/" . $file);

    $conn->query("INSERT INTO assignments (title, subject, file_path) VALUES ('$title', '$subject', '$file')");
    $msg = "Assignment uploaded successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Assignment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
       background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      margin-top: 0;
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="file"],
    button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      text-align: center;
      color: green;
      margin-top: 10px;
      font-weight: bold;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #007bff;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Upload Assignment</h2>
    <form method="post" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="Assignment Title" required>
      <input type="text" name="subject" placeholder="Subject" required>
      <input type="file" name="assignment" required>
      <button name="upload">Upload</button>
    </form>
    <?php if (isset($msg)) echo "<div class='message'>$msg</div>"; ?>
    <a class="back-link" href="teacher_dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
