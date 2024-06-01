<?php
class CompletedController {
    public function index() {
        $model = new CompletedModel();
        $data = $model->getData();
        require 'View/completed.php';
    }
}
?>
