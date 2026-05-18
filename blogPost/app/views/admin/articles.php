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
    <title>Article Management</title>
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
                <a href="articles.php" class="active">📝 Articles</a>
                <a href="comments.php">💬 Comments</a>
                <a href="applications.php">📋 Applications</a>
                <a href="settings.php">⚙️ Settings</a>
                <a href="../../logout.php">🚪 Logout</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="page-header">
                <h1>Article Management</h1>
                <p>Manage all articles</p>
            </div>

            <?php if($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <div class="filters-section">
                <form method="GET" class="filter-form">
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="draft" <?php echo $filters['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="submitted" <?php echo $filters['status'] == 'submitted' ? 'selected' : ''; ?>>Submitted</option>
                        <option value="approved" <?php echo $filters['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                        <option value="published" <?php echo $filters['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th><th>Status</th><th>Views</th><th>Featured</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $article): ?>
                        <tr>
                            <td><?php echo $article['id']; ?></td>
                            <td><?php echo htmlspecialchars(substr($article['title'], 0, 50)); ?></td>
                            <td><?php echo htmlspecialchars($article['author_name']); ?></td>
                            <td><?php echo htmlspecialchars($article['category_name'] ?? 'Uncategorized'); ?></td>
                            <td><span class="badge <?php echo $article['status'] == 'published' ? 'badge-active' : 'badge-pending'; ?>"><?php echo ucfirst($article['status']); ?></span></td>
                            <td><?php echo $article['view_count']; ?></td>
                            <td><button onclick="toggleFeatured(<?php echo $article['id']; ?>, this)" class="featured-btn <?php echo $article['is_featured'] ? 'featured' : ''; ?>"><?php echo $article['is_featured'] ? '★ Featured' : '☆ Not Featured'; ?></button></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Delete this article?');">
                                    <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                                    <button type="submit" name="delete_article" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../../assets/js/admin-ajax.js"></script>
</body>
</html>