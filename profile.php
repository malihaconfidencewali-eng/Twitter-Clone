<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get profile username from URL
$profile_username = isset($_GET['username']) ? $_GET['username'] : $_SESSION['username'];

// Handle follow/unfollow
if(isset($_POST['follow_action'])) {
    $follower = $_SESSION['username'];
    $following = $profile_username;
    
    $follows_file = 'follows.txt';
    $follows = file_exists($follows_file) ? file($follows_file, FILE_IGNORE_NEW_LINES) : [];
    
    $follow_string = $follower . "|||" . $following;
    $follow_index = array_search($follow_string, $follows);
    
    if($follow_index !== false) {
        // Unfollow
        unset($follows[$follow_index]);
    } else {
        // Follow
        $follows[] = $follow_string;
    }
    
    file_put_contents($follows_file, implode("\n", $follows) . "\n");
    header("Location: profile.php?username=" . urlencode($profile_username));
    exit();
}

// Check if following
$isFollowing = false;
if(file_exists('follows.txt')) {
    $follows = file('follows.txt', FILE_IGNORE_NEW_LINES);
    $follow_string = $_SESSION['username'] . "|||" . $profile_username;
    $isFollowing = in_array($follow_string, $follows);
}

// Get follower and following counts
$followers_count = 0;
$following_count = 0;
if(file_exists('follows.txt')) {
    $follows = file('follows.txt', FILE_IGNORE_NEW_LINES);
    foreach($follows as $follow) {
        list($follower, $following) = explode("|||", $follow);
        if($following == $profile_username) $followers_count++;
        if($follower == $profile_username) $following_count++;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile / Twitter</title>
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
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 15px;
            background-color: #1C2732;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
        }

        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            margin-bottom: 20px;
        }

        .profile-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .profile-username {
            color: #8899A6;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .follow-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            color: #8899A6;
        }

        .stat-number {
            color: #FFFFFF;
            font-weight: bold;
        }

        .follow-button {
            background-color: #1DA1F2;
            color: white;
            border: none;
            border-radius: 9999px;
            padding: 8px 16px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .following-button {
            background-color: transparent;
            border: 1px solid #1DA1F2;
            color: #1DA1F2;
        }

        .profile-info {
            margin-top: 15px;
            color: #8899A6;
        }

        .join-date {
            margin-top: 10px;
            color: #8899A6;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">Profile</h1>
            <div class="profile-username">@<?php echo htmlspecialchars($profile_username); ?></div>
            
            <div class="follow-stats">
                <div>
                    <span class="stat-number"><?php echo $following_count; ?></span> Following
                </div>
                <div>
                    <span class="stat-number"><?php echo $followers_count; ?></span> Followers
                </div>
            </div>

            <?php if ($profile_username != $_SESSION['username']): ?>
                <form method="POST">
                    <input type="hidden" name="follow_action" value="1">
                    <button type="submit" class="follow-button <?php echo $isFollowing ? 'following-button' : ''; ?>">
                        <?php echo $isFollowing ? 'Following' : 'Follow'; ?>
                    </button>
                </form>
            <?php endif; ?>

            <div class="profile-info">
                Amazing
            </div>
            <div class="join-date">
                Dec 25
            </div>
        </div>
    </div>
</body>
</html>
