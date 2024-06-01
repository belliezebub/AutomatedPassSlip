<?php
session_start();
require_once 'Config/Database.php'; // Include the Database class
require 'Controller/PagesController.php';

$database = new Database();
$mysqli = $database->getConnection();
$page = new PagesController();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $page->home();
} else {
    $page->login();
}
?>
