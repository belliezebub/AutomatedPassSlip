<?php
    require_once 'Controller/PagesController.php';
    require_once 'Controller/UserProfileController.php';

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
            $controller = new UserProfilesController();
            
            switch ($page) {
                case 'dashboard':
                    $controller->handleRequest();
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
                    $controller->handleRequest();
                    break;
            }
        }
    }
?>
