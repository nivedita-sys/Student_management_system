<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");

// Fetch all submitted assignments
$sql = "SELECT sa.id, s.name AS student_name, sa.assignment_title, sa.file_path, sa.submitted_at
        FROM submitted_assignments sa
        JOIN students s ON sa.student_id = s.id
        ORDER BY sa.submitted_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>View Submitted Assignments</title>
<style>
  html, body {
    height: 100%;
    margin: 0;
    background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    align-items: center;        /* vertical centering */
    justify-content: center;    /* horizontal centering */
  }
  body {
    flex-direction: column;
    padding: 20px;
    box-sizing: border-box;
  }
  h2 {
    margin-bottom: 30px;
    font-size: 2.5rem;
    color: #222;
    text-align: center;
    text-shadow: 0 0 5px rgba(0,0,0,0.1);
  }
  table {
    border-collapse: collapse;
    width: 100%;
    max-width: 900px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    border-radius: 12px;
    overflow: hidden;
    font-size: 1.1rem;
  }
  th, td {
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    color: #111;
  }
  th {
    background-color: #0056b3;
    color: #f9f9f9;
    font-weight: 700;
  }
  tr:hover {
    background-color: #e6f0ff;
  }
  a {
    color: #0056b3;
    text-decoration: none;
    font-weight: 600;
  }
  a:hover {
    text-decoration: underline;
  }
  .back-link {
    margin-top: 40px;
    font-size: 1.3rem;
    font-weight: 600;
    text-align: center;
    color: #0056b3;
  }
</style>
</head>
<body>
  <h2>Submitted Assignments</h2>
  <table>
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Assignment Title</th>
        <th>Submitted File</th>
        <th>Submitted At</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= htmlspecialchars($row['student_name']) ?></td>
          <td><?= htmlspecialchars($row['assignment_title']) ?></td>
          <td><a href="../submissions/<?= htmlspecialchars($row['file_path']) ?>" download>Download</a></td>
          <td><?= htmlspecialchars($row['submitted_at']) ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a class="back-link" href="teacher_dashboard.php">← Back to Dashboard</a>
</body>
</html>
