<?php
require_once 'Controller/PassSlipController.php';

$controller = new PassSlipController();
$teachers = $controller->getTeachers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $controller->createPassSlip($_POST);
    echo "<script>
            alert('$message');
            window.history.go(-2);
          </script>";
}

include_once 'View/PassSlipForm.php';
?>
