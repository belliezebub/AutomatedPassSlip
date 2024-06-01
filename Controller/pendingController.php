<?php
class PendingController {
    public function index() {
        $model = new PendingModel();
        $data = $model->getData();
        require 'View/pending.php';
    }
}
?>
