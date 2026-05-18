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
    $settings = [
        'registration_mode' => $_POST['registration_mode'],
        'comment_permission' => $_POST['comment_permission'],
        'guest_visibility' => $_POST['guest_visibility']
    ];
    
    $success = true;
    foreach($settings as $key => $value) {
        if(!$adminModel->updateSetting($key, $value)) {
            $success = false;
            break;
        }
    }
    
    if($success) {
        $message = "Settings updated successfully";
    } else {
        $error = "Failed to update settings";
    }
}

$current_settings = $adminModel->getSettings();

include __DIR__ . '/../../views/admin/settings.php';
?>