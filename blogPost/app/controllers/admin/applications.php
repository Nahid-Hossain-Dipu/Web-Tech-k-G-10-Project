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

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process_application'])) {
    $application_id = $_POST['application_id'];
    $status = $_POST['status'];
    
    if($adminModel->processApplication($application_id, $status, $_SESSION['user_id'])) {
        $message = "Application " . $status . " successfully";
    } else {
        $error = "Failed to process application";
    }
}

$applications = $adminModel->getPendingApplications();

include __DIR__ . '/../../views/admin/applications.php';
?>