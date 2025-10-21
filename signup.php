<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        $error = "Username already exists";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign up for Twitter</title>
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
            width: 40px;
            height: 40px;
            margin-bottom: 20px;
        }

        .signup-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        h1 {
            font-size: 31px;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #1DA1F2;
            font-size: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            background-color: #000000;
            border: 1px solid #333;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #1DA1F2;
        }

        .sign-up-btn {
            width: 100%;
            padding: 15px;
            background-color: #1DA1F2;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .sign-up-btn:hover {
            background-color: #1a91da;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6e767d;
        }

        .login-link a {
            color: #1DA1F2;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            background-color: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff0000;
            color: #ff0000;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <svg viewBox="0 0 24 24" class="twitter-icon" style="fill: #1DA1F2;">
        <g><path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"></path></g>
    </svg>

    <div class="signup-container">
        <h1>Sign up for Twitter</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="sign-up-btn">Sign up</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>
</body>
</html> 
