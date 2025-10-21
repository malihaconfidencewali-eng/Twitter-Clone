<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle new tweet
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet'])) {
    $tweet = $_POST['tweet'];
    $username = $_SESSION['username']; // Get username from session
    
    // Store tweet with username
    $tweets_file = 'tweets.txt';
    $tweet_data = $username . "|||" . $tweet . "|||" . date('Y-m-d H:i:s') . "\n";
    file_put_contents($tweets_file, $tweet_data, FILE_APPEND);
}

// Read all tweets
$tweets = [];
if (file_exists('tweets.txt')) {
    $lines = file('tweets.txt', FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($username, $content, $time) = explode("|||", $line);
        $tweets[] = [
            'username' => $username,
            'content' => $content,
            'created_at' => $time
        ];
    }
    $tweets = array_reverse($tweets);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home / Twitter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #15202B;
            color: #ffffff;
            line-height: 1.5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .welcome-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
        }

        .welcome-header h1 {
            font-size: 24px;
            color: #ffffff;
        }

        .tweet-form-container {
            background-color: #192734;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .tweet-form-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .tweet-input {
            width: 100%;
            min-height: 100px;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background-color: #253341;
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 15px;
            resize: none;
        }

        .tweet-button {
            background-color: #1da1f2;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .tweet-button:hover {
            background-color: #1991da;
        }

        .tweet {
            background-color: #192734;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .tweet-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .tweet-username {
            color: #1da1f2;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .tweet-username:hover {
            text-decoration: underline;
        }

        .tweet-time {
            color: #8899a6;
            font-size: 14px;
        }

        .tweet-content {
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .nav-links a:hover {
            background-color: #253341;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-header">
            <h1>Welcome to Twitter Clone</h1>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="tweet-form-container">
            <h2 class="tweet-form-title">Post a New Tweet</h2>
            <form method="POST">
                <textarea class="tweet-input" name="tweet" placeholder="What's happening?" maxlength="280" required></textarea>
                <button type="submit" class="tweet-button">Tweet</button>
            </form>
        </div>

        <div class="tweets-container">
            <?php foreach ($tweets as $tweet): ?>
                <div class="tweet">
                    <div class="tweet-header">
                        <a href="profile.php?username=<?php echo urlencode($tweet['username']); ?>" class="tweet-username">
                            @<?php echo htmlspecialchars($tweet['username']); ?>
                        </a>
                        <span class="tweet-time"><?php echo date('M j', strtotime($tweet['created_at'])); ?></span>
                    </div>
                    <div class="tweet-content">
                        <?php echo htmlspecialchars($tweet['content']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

