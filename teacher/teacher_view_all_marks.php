<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['teacher'])) header("Location: teacher_login.php");

$sql = "SELECT s.id, s.name, m.subject, m.marks 
        FROM students s 
        LEFT JOIN marks m ON s.id = m.student_id
        ORDER BY s.name, m.subject";

$result = $conn->query($sql);

// Group data by student
$students = [];
while ($row = $result->fetch_assoc()) {
    $sid = $row['id'];
    if (!isset($students[$sid])) {
        $students[$sid] = [
            'name' => $row['name'],
            'subjects' => []
        ];
    }
    if ($row['subject']) {
        $students[$sid]['subjects'][] = $row['subject'] . ': ' . $row['marks'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Student Marks</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ac29a, #bdfff3);
      padding: 40px 20px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      color: #fff;
      font-size: 28px;
      margin-bottom: 40px;
      animation: fadeIn 1s ease;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
      max-width: 1200px;
      animation: fadeIn 1.5s ease;
    }

    .card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      padding: 20px;
      width: 280px;
      transition: transform 0.3s ease;
      animation: slideUp 0.5s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      margin: 0;
      color: #1e3c72;
    }

    .card ul {
      list-style: none;
      padding: 0;
      margin: 10px 0 0;
    }

    .card ul li {
      color: #444;
      margin: 5px 0;
    }

    .card p {
      margin: 10px 0 0;
      color: #777;
    }

    .back-link {
      display: inline-block;
      margin-top: 50px;
      padding: 10px 25px;
      background-color: #1e3c72;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .back-link:hover {
      background-color: #16325c;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>

  <h2>All Student's Marks</h2>

  <div class="card-container">
    <?php foreach ($students as $student) { ?>
      <div class="card">
        <h3><?= htmlspecialchars($student['name']) ?></h3>
        <?php if (count($student['subjects'])) { ?>
          <ul>
            <?php foreach ($student['subjects'] as $subMark) { ?>
              <li><?= htmlspecialchars($subMark) ?></li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <p>No marks available.</p>
        <?php } ?>
      </div>
    <?php } ?>
  </div>

  <a class="back-link" href="teacher_dashboard.php">← Back to Dashboard</a>

</body>
</html>
