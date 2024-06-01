<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    include_once 'controllers/PassSlipApprovalController.php';

    $controller = new PassSlipController();
    $passSlip = $controller->getPassSlip($id);

    include 'views/PassSlipApprovalView.php';
} else {
    header("Location: login.php");
    exit();
}
?>