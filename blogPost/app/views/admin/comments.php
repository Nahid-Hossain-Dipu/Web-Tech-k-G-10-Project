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
    <title>Comment Moderation</title>
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
                <a href="comments.php" class="active">💬 Comments</a>
                <a href="applications.php">📋 Applications</a>
                <a href="settings.php">⚙️ Settings</a>
                <a href="../../logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>Comment Moderation</h1>
                <p>Manage user comments</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Comment</th><th>User</th><th>Article</th><th>Date</th><th>Reports</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $comment): ?>
                        <tr>
                            <td><?php echo $comment['id']; ?></td>
                            <td><?php echo htmlspecialchars(substr($comment['body'], 0, 100)); ?></td>
                            <td><?php echo htmlspecialchars($comment['user_name']); ?></td>
                            <td><?php echo htmlspecialchars(substr($comment['article_title'], 0, 50)); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($comment['created_at'])); ?></td>
                            <td><?php if($comment['report_count'] > 0): ?><span class="badge" style="background:#ffc107;">⚠️ <?php echo $comment['report_count']; ?></span><?php else: ?>✓ No reports<?php endif; ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" name="delete_comment" class="btn btn-danger" onclick="return confirm('Delete this comment?')">Delete</button>
                                </form>
                                <?php if($comment['report_count'] > 0): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" name="resolve_reports" class="btn btn-success">Resolve</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>