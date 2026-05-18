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
    <title>Author Applications</title>
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
                <a href="applications.php" class="active">📋 Applications</a>
                <a href="settings.php">⚙️ Settings</a>
                <a href="../../logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>Author Applications</h1>
                <p>Review author requests</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Applicant</th><th>Email</th><th>Motivation</th><th>Submitted</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($applications as $app): ?>
                        <tr>
                            <td><?php echo $app['id']; ?></td>
                            <td><?php echo htmlspecialchars($app['name']); ?></td>
                            <td><?php echo htmlspecialchars($app['email']); ?></td>
                            <td><?php echo htmlspecialchars(substr($app['motivation'], 0, 100)); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($app['submitted_at'])); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" name="process_application" class="btn btn-success">Approve</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" name="process_application" class="btn btn-danger">Reject</button>
                                </form>
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