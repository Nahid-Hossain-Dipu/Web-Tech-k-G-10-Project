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
    <title>User Management</title>
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
                <a href="users.php" class="active">👥 Users</a>
                <a href="articles.php">📝 Articles</a>
                <a href="comments.php">💬 Comments</a>
                <a href="applications.php">📋 Applications</a>
                <a href="settings.php">⚙️ Settings</a>
                <a href="../../logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>User Management</h1>
                <p>Manage all platform users</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="search-box">
                <form method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Search users..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">🔍 Search</button>
                </form>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="role" onchange="this.form.submit()">
                                        <option value="reader" <?php echo $user['role'] == 'reader' ? 'selected' : ''; ?>>Reader</option>
                                        <option value="author" <?php echo $user['role'] == 'author' ? 'selected' : ''; ?>>Author</option>
                                        <option value="editor" <?php echo $user['role'] == 'editor' ? 'selected' : ''; ?>>Editor</option>
                                        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    </select>
                                    <input type="submit" name="change_role" value="Update" style="display:none;">
                                </form>
                            </td>
                            <td>
                                <span class="badge <?php echo $user['is_active'] ? 'badge-active' : 'badge-inactive'; ?>">
                                    <?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="is_active" value="<?php echo $user['is_active']; ?>">
                                    <button type="submit" name="toggle_status" class="btn <?php echo $user['is_active'] ? 'btn-warning' : 'btn-success'; ?>">
                                        <?php echo $user['is_active'] ? 'Deactivate' : 'Activate'; ?>
                                    </button>
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