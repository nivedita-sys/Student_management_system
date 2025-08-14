<?php 
session_start();
include '../includes/db.php';

if (isset($_POST['login'])) {
    $username = strtolower(trim($_POST['username']));
    $password = trim($_POST['password']);

    // ✅ Correct table name is "teachers"
    $sql = "SELECT * FROM teachers WHERE LOWER(name) = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $teacher = $result->fetch_assoc();
        
        if ($teacher['password'] === $password) {
            $_SESSION['teacher'] = $teacher;
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Name not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Teacher Login</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

  /* Reset & base */
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }

  body, html {
    height: 100%;
    font-family: 'Poppins', sans-serif;
    /* Background image (dark, subtle texture) */
    background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #eee;
    padding: 20px;
    position: relative;
  }

  /* Dark overlay for better contrast */
  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(20, 30, 50, 0.75);
    backdrop-filter: blur(8px);
    z-index: 0;
  }

  .login-card {
    position: relative;
    z-index: 1;
    background: rgba(30, 41, 59, 0.9);
    padding: 45px 40px 40px;
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.6);
    max-width: 380px;
    width: 100%;
    text-align: center;
    border: 2px solid #5E81AC;
  }

  h2 {
    margin-bottom: 30px;
    font-weight: 600;
    font-size: 2.2rem;
    color: #A3BE8C;
    text-shadow: 0 0 8px #A3BE8CAA;
  }

  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 15px 18px;
    margin-bottom: 22px;
    border-radius: 12px;
    border: none;
    font-size: 1rem;
    font-weight: 500;
    outline: none;
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
    background: rgba(255, 255, 255, 0.12);
    color: #D8DEE9;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
  }

  input[type="text"]::placeholder,
  input[type="password"]::placeholder {
    color: #B0BEC5;
  }

  input[type="text"]:focus, input[type="password"]:focus {
    box-shadow: 0 0 12px #88C0D0;
    background: rgba(255, 255, 255, 0.25);
  }

  button[name="login"] {
    width: 100%;
    padding: 15px 0;
    border: none;
    border-radius: 14px;
    font-weight: 700;
    font-size: 1.2rem;
    color: #2E3440;
    background: #A3BE8C;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 7px 18px #A3BE8Cbb;
    user-select: none;
  }

  button[name="login"]:hover {
    background-color: #8FBCBB;
    box-shadow: 0 9px 25px #8FBCBBdd;
  }

  p.back-link {
    margin-top: 22px;
  }

  p.back-link a {
    color: #88C0D0;
    text-decoration: underline;
    font-weight: 600;
    transition: color 0.3s ease;
  }

  p.back-link a:hover {
    color: #D8DEE9;
  }

  .error-message {
    margin-top: 18px;
    font-weight: 700;
    color: #BF616A;
    text-shadow: 0 0 7px #BF616Aaa;
  }

  @media (max-width: 450px) {
    .login-card {
      padding: 35px 25px 30px;
      max-width: 320px;
    }
    h2 {
      font-size: 1.9rem;
    }
  }
</style>

</head>
<body>
  <div class="login-card">
    <h2>Teacher Login</h2>
    <form method="post" autocomplete="off" novalidate>
      <input type="text" name="username" placeholder="Username (Your Name)" required />
      <input type="password" name="password" placeholder="Password" required />
      <button name="login" type="submit">Login</button>
    </form>

    <p class="back-link">
      <a href="../index.php" title="Back to Dashboard">← Back to Dashboard</a>
    </p>

    <?php if (isset($error)): ?>
      <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
