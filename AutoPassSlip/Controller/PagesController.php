<?php
require_once 'Controller/UserController.php';
require_once 'Controller/HomePageController.php';

class PagesController { 
    public function redirectToLoginPage() {
        // Redirect to the home page
        header("Location: index.php");
        exit();
    }  

    function login() {
        // Usage
        $controller = new UserController();
        $controller->initiate();
    }

    function home() {
        $controller = new HomePageController();
        $controller->run();
    }

    function logout() {
        $controller = new UserController();
        $controller->logout();
        $this->home(); // Corrected
    }
}
?>
