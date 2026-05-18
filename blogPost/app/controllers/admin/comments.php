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

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['delete_comment'])) {
        $comment_id = $_POST['comment_id'];
        if($adminModel->deleteComment($comment_id)) {
            $message = "Comment deleted successfully";
        }
    }
    
    if(isset($_POST['resolve_reports'])) {
        $comment_id = $_POST['comment_id'];
        if($adminModel->resolveReports($comment_id)) {
            $message = "Reports resolved successfully";
        }
    }
}

$comments = $adminModel->getAllCommentsWithReports();

include __DIR__ . '/../../views/admin/comments.php';
?>