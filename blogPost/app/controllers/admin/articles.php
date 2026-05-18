<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/AdminModel.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php');
    exit;
}

$adminModel = new AdminModel();
$message = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_article'])) {
    $article_id = $_POST['article_id'];
    if($adminModel->deleteArticle($article_id)) {
        $message = "Article deleted successfully";
    } else {
        $error = "Failed to delete article";
    }
}

$filters = [
    'status' => $_GET['status'] ?? ''
];

$articles = $adminModel->getAllArticles($filters);

include __DIR__ . '/../../views/admin/articles.php';
?>