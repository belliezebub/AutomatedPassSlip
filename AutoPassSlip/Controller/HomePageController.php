<?php
    require_once 'Controller/PagesController.php';


    class HomePageController {
        public function run() {
            
            $pageController = new PagesController();
            // If user is not logged in, initiate login process
            if (!isset($_SESSION['user_id'])) {
                
                $pageController->redirectToLoginPAge();
                return;
            }
            
            // If user is logged in, continue with page routing
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    
            switch ($page) {
                case 'dashboard':
                    require 'profile.php';
                    break;
                case 'completed':
                    $controller = new CompletedController();
                    $controller->index();
                    break;
                case 'pending':
                    $controller = new PendingController();
                    $controller->index();
                    break;
                case 'unprocessed':
                    $controller = new UnprocessedController();
                    $controller->index();
                    break;
                case 'logout':
                    $pageController->logout();
                default:
                    require 'profile.php';
                    break;
            }
        }
    }
?>
