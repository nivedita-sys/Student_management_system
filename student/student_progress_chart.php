<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['student'])) header("Location: student_login.php");

$student_id = $_SESSION['student']['id'];
$result = $conn->query("SELECT subject, marks FROM marks WHERE student_id=$student_id");

$subjects = [];
$marks = [];

while ($row = $result->fetch_assoc()) {
    $subjects[] = $row['subject'];
    $marks[] = $row['marks'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Progress Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f3e5f5, #e1f5fe);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            padding: 20px;
        }

        h2 {
            color: #2e7d32;
            font-size: 32px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px #ccc;
        }

        .chart-container {
            width: 90%;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(6px);
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        a {
            margin-top: 30px;
            padding: 12px 25px;
            background: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        a:hover {
            background: #004d40;
        }

        /* Background bubbles */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }

        .circle.c1 { width: 140px; height: 140px; background: #ffb74d; top: 15%; left: 10%; animation-delay: 0s; }
        .circle.c2 { width: 100px; height: 100px; background: #4fc3f7; top: 30%; left: 70%; animation-delay: 2s; }
        .circle.c3 { width: 120px; height: 120px; background: #aed581; top: 65%; left: 20%; animation-delay: 4s; }
        .circle.c4 { width: 90px; height: 90px; background: #ba68c8; top: 75%; left: 80%; animation-delay: 6s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
    </style>
</head>
<body>
    <!-- Animated background circles -->
    <div class="circle c1"></div>
    <div class="circle c2"></div>
    <div class="circle c3"></div>
    <div class="circle c4"></div>

    <h2>📊 Progress Chart</h2>
    <div class="chart-container">
        <canvas id="progressChart"></canvas>
    </div>

    <a href="student_dashboard.php">⬅ Back to Dashboard</a>

    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($subjects) ?>,
                datasets: [{
                    label: 'Marks',
                    data: <?= json_encode($marks) ?>,
                    backgroundColor: 'rgba(76, 175, 80, 0.7)',
                    borderColor: 'rgba(56, 142, 60, 1)',
                    borderWidth: 1,
                    barThickness: 40, // Adjusted bar thickness
                    maxBarThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#2e7d32',
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
