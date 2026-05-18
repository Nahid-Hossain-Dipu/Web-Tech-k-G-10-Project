<?php
// Check admin access
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /Sample_Project10/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Sample_Project10/assets/css/admin-style.css">
    <style>
        /* Quick fallback styles if CSS doesn't load */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #2c3e50; color: white; }
        .sidebar-header { padding: 20px; background: #1a252f; }
        .sidebar nav a { display: block; padding: 12px 20px; color: white; text-decoration: none; }
        .sidebar nav a:hover { background: #1a252f; }
        .main-content { flex: 1; padding: 20px; }
        .page-header { background: white; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .stat-number { font-size: 32px; font-weight: bold; color: #667eea; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Blog Platform</h2>
                <p>Admin Panel</p>
            </div>
            <nav>
                <a href="/Sample_Project10/controllers/admin/dashboard.php" class="active">📊 Dashboard</a>
                <a href="/Sample_Project10/controllers/admin/users.php">👥 Users</a>
                <a href="/Sample_Project10/controllers/admin/articles.php">📝 Articles</a>
                <a href="/Sample_Project10/controllers/admin/comments.php">💬 Comments</a>
                <a href="/Sample_Project10/controllers/admin/applications.php">📋 Applications</a>
                <a href="/Sample_Project10/controllers/admin/settings.php">⚙️ Settings</a>
                <a href="/Sample_Project10/logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Here's what's happening with your platform today.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <div class="stat-number"><?php echo array_sum($stats['users_by_role']); ?></div>
                    <div class="stat-details">
                        <span>👥 Readers: <?php echo $stats['users_by_role']['reader'] ?? 0; ?></span><br>
                        <span>✍️ Authors: <?php echo $stats['users_by_role']['author'] ?? 0; ?></span><br>
                        <span>📝 Editors: <?php echo $stats['users_by_role']['editor'] ?? 0; ?></span>
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Published Articles</h3>
                    <div class="stat-number"><?php echo $stats['total_published']; ?></div>
                </div>

                <div class="stat-card">
                    <h3>Total Comments</h3>
                    <div class="stat-number"><?php echo $stats['total_comments']; ?></div>
                </div>

                <div class="stat-card">
                    <h3>New Users (Week)</h3>
                    <div class="stat-number"><?php echo $stats['new_users_week']; ?></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>