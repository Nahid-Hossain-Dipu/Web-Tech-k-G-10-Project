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
    if(isset($_POST['toggle_status'])) {
        $user_id = $_POST['user_id'];
        $is_active = $_POST['is_active'];
        if($adminModel->updateUserStatus($user_id, !$is_active)) {
            $message = "User status updated successfully";
        }
    }
    
    if(isset($_POST['change_role'])) {
        $user_id = $_POST['user_id'];
        $role = $_POST['role'];
        if($adminModel->updateUserRole($user_id, $role)) {
            $message = "User role updated successfully";
        }
    }
}

$search = $_GET['search'] ?? '';
$users = $adminModel->getAllUsers($search);

include __DIR__ . '/../../views/admin/users.php';
?>