<?php
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Settings</title>
    <link rel="stylesheet" href="../../assets/css/admin-style.css">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Blog Platform</h2>
                <p>Admin Panel</p>
            </div>
            <nav>
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👥 Users</a>
                <a href="articles.php">📝 Articles</a>
                <a href="comments.php">💬 Comments</a>
                <a href="applications.php">📋 Applications</a>
                <a href="settings.php" class="active">⚙️ Settings</a>
                <a href="../../logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>Platform Settings</h1>
                <p>Configure your platform</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="settings-form">
                <form method="POST">
                    <div class="form-group">
                        <label>Registration Mode</label>
                        <select name="registration_mode">
                            <option value="open" <?php echo ($current_settings['registration_mode'] ?? '') == 'open' ? 'selected' : ''; ?>>Open Registration</option>
                            <option value="invite_only" <?php echo ($current_settings['registration_mode'] ?? '') == 'invite_only' ? 'selected' : ''; ?>>Invite Only</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Comment Permissions</label>
                        <select name="comment_permission">
                            <option value="all_users" <?php echo ($current_settings['comment_permission'] ?? '') == 'all_users' ? 'selected' : ''; ?>>All Users</option>
                            <option value="members_only" <?php echo ($current_settings['comment_permission'] ?? '') == 'members_only' ? 'selected' : ''; ?>>Members Only</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Guest Visibility</label>
                        <select name="guest_visibility">
                            <option value="read_only" <?php echo ($current_settings['guest_visibility'] ?? '') == 'read_only' ? 'selected' : ''; ?>>Read Only</option>
                            <option value="restricted" <?php echo ($current_settings['guest_visibility'] ?? '') == 'restricted' ? 'selected' : ''; ?>>Restricted</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>