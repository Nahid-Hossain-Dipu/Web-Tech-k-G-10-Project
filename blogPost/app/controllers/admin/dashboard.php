<?php
// Enable error reporting to see any issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use absolute paths
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sample_Project10/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sample_Project10/models/AdminModel.php';

// Check admin access
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /Sample_Project10/login.php');
    exit;
}

$adminModel = new AdminModel();
$stats = $adminModel->getDashboardStats();

// Include the view
include $_SERVER['DOCUMENT_ROOT'] . '/Sample_Project10/views/admin/dashboard.php';
?>