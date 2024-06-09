<?php
require_once 'Config/Database.php'; // Include the Database class
require_once 'Model/UserProfileModel.php'; // Include the model file
require_once 'Model/TaskCount.php'; // Include the TaskCount model file

class UserProfilesController {
    private $userModel;
    private $mysqli;

    public function __construct() {
        $database = new Database();
        $this->mysqli = $database->getConnection();
        $this->userModel = new UserProfileModel($this->mysqli);
    }

    private function initView($userId, $pendingTasks, $unprocessedTasks, $completedTasks) {
        // Fetch the user profile
        $user = $this->userModel->getUserProfile($userId);
        
        // Include the view
        require 'View/profileView.php';
    }

    public function handleRequest() {   
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php');
            exit();
        }

        $userId = $_SESSION['user_id']; // Get the user ID from the session

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $this->uploadProfilePicture($userId, $_FILES['file']);
        } else {
            $this->profile($userId);
        }
    }

    public function profile($userId) {
        // Fetch the user profile
        $user = $this->userModel->getUserProfile($userId);
        
        // Check if user data is retrieved successfully
        if ($user) {
            // Initialize task count
            $taskCount = new TaskCount($this->mysqli, $userId, $user['firstname']);
            
            // Count tasks
            $pendingTasks = $taskCount->countPendingTasks();
            $unprocessedTasks = $taskCount->countUnprocessedTasks();
            $completedTasks = $taskCount->countCompletedTasks();
    
            // Display the view
            $this->initView($userId, $pendingTasks, $unprocessedTasks, $completedTasks);
        } else {
            // Handle case where user data is not found
            echo "User profile not found.";
        }
    }
    

    public function uploadProfilePicture($userId, $file) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        if ($file["size"] > 500000) {
            die("Sorry, your file is too large.");
        }

        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            die("Sorry, only JPG, JPEG files are allowed.");
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            $this->userModel->updateProfilePicture($userId, $targetFile);
            header("Location: index.php");
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    }
}
?>
