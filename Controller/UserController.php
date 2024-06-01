<?php
include_once './Config/Database.php';
include_once './Model/User.php';

class UserController {
    public function login($username, $password) {
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $user->username = $username;
        $user->password = $password;

        if ($user->login()) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            //$_SESSION['firstname']
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function initiate() {
        // Get the current URL
        $current_url = $_SERVER['REQUEST_URI'];
    
        // Extract the directory part of the URL
        $directory = dirname($current_url);
    
        // Extract the file part of the URL
        $filename = basename($current_url);
    
        // Replace the file part with 'login'
        $redirect_url = $directory . '/Login';
    
        $error = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            if ($this->login($username, $password)) {
                header("Location: index.php");
                exit();
            } else {
                $error = true;
                include 'View/login_view.php';
            }
        } else {
            include 'View/login_view.php';
        }
    }
    
}
?>
