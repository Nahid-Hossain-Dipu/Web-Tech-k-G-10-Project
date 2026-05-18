<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/AdminModel.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'])) {
    $adminModel = new AdminModel();
    $result = $adminModel->toggleFeatured($_POST['article_id']);
    
    if($result !== false) {
        echo json_encode([
            'success' => true, 
            'is_featured' => $result,
            'message' => 'Featured status updated'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>