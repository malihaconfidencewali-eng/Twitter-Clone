<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Accept any username and password
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $_SESSION['user_id'] = 1; // Default user ID
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login to Twitter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #000000;
            color: #ffffff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .twitter-icon {
            color: #1DA1F2;
            font-size: 45px;
            margin-bottom: 30px;
        }

        .login-container {
            width: 100%;
            max-width: 364px;
            padding: 20px;
        }

        h1 {
            font-size: 31px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #1DA1F2;
            font-size: 15px;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            background-color: rgb(30, 39, 50);
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 17px;
        }

        input:focus {
            outline: none;
        }

        .sign-in-btn {
            width: 100%;
            padding: 15px;
            background-color: rgb(29, 155, 240);
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .sign-in-btn:hover {
            background-color: rgb(26, 140, 216);
        }

        .signup-text {
            text-align: center;
            margin-top: 40px;
            color: rgb(113, 118, 123);
            font-size: 15px;
        }

        .signup-link {
            color: rgb(29, 155, 240);
            text-decoration: none;
        }

        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <i class="fab fa-twitter twitter-icon"></i>

    <div class="login-container">
        <h1>Login to Twitter</h1>
        
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit" class="sign-in-btn">Login</button>
        </form>
        
        <div class="signup-text">
            Don't have an account? <a href="signup.php" class="signup-link">Sign up</a>
        </div>
    </div>
</body>
</html>
