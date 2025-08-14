<?php
session_start();
include '../includes/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['student'] = $result->fetch_assoc();
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Login</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

    * {
        margin: 0; padding: 0; box-sizing: border-box;
    }

    html, body {
        height: 100%;
        font-family: 'Poppins', sans-serif;
        overflow: hidden;
        background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1740&q=80') no-repeat center center fixed;
        background-size: cover;
    }

    .overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(3px);
        z-index: 0;
    }

    .login-box {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.75);
        padding: 45px 40px;
        border-radius: 15px;
        width: 380px;
        color: #ffffff;
        text-align: center;
        z-index: 1;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }

    .login-box h2 {
        font-size: 32px;
        margin-bottom: 30px;
        text-shadow: 0 0 10px #00f0ff;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 14px 18px;
        margin-bottom: 25px;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        outline: none;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 10px #00f0ff;
    }

    button {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 18px;
        color: #fff;
        background: linear-gradient(90deg, #00f0ff, #005eff);
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 255, 255, 0.4);
    }

    button:hover {
        background: linear-gradient(90deg, #005eff, #00f0ff);
        box-shadow: 0 6px 20px rgba(0, 255, 255, 0.6);
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 22px;
        border-radius: 12px;
        background-color: #005eff;
        color: #fff;
        font-size: 15px;
        text-decoration: none;
        box-shadow: 0 0 10px #005eff;
    }

    .back-link:hover {
        background-color: #00f0ff;
        box-shadow: 0 0 20px #00f0ff;
    }

    .error {
        margin-top: 15px;
        color: #ff4b4b;
        font-weight: 600;
    }

    @media (max-width: 420px) {
        .login-box {
            width: 90%;
        }
    }
</style>
</head>
<body>
<div class="overlay"></div>

<div class="login-box">
    <form method="post" autocomplete="off">
        <h2>Student Login</h2>
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit" name="login">Login</button>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
    <a class="back-link" href="../index.php">← Go Back to Homepage</a>
</div>

</body>
</html>
