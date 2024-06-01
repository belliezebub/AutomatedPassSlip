<?php
require_once 'Controller\PassSlipController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PassSlipController();
    $message = $controller->createPassSlip($_POST);
    echo "<script>alert('$message');</script>";
}

include_once 'View\PassSlipForm.php';
?>
