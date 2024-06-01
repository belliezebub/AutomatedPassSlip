<?php
require_once 'Model/UserProfileModel.php';
require_once 'Model\TaskCount.php';

class UserProfilesController {
    private $userModel;
    private $mysqli;

    public function __construct($mysqli) {
        $this->userModel = new UserProfileModel($mysqli);
        $this->mysqli = $mysqli;
    }

    public function profile($userId) {
        $user = $this->userModel->getUserProfile($userId);
        $taskCount = new TaskCount($this->mysqli, $userId, $user['firstname']);
        
        $pendingTasks = $taskCount->countPendingTasks();
        $unprocessedTasks = $taskCount->countUnprocessedTasks();
        $completedTasks = $taskCount->countCompletedTasks();

        require 'View/profileView.php';
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
