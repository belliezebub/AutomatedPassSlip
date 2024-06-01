<?php
require_once 'Config/Database.php'; // Include the Database class

$database = new Database();
$mysqli = $database->getConnection();

require_once 'Controller/UserProfileController.php'; // Include the controller file

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php' );
    exit();
}

$userId = $_SESSION['user_id']; // Get the user ID from the session

$controller = new UserProfilesController($mysqli); // Pass $mysqli to the controller

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $controller->uploadProfilePicture($userId, $_FILES['file']);
} else {
    $controller->profile($userId);
}
?>
