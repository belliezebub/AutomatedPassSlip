<?php
class UnprocessedController {
    public function index() {
        $model = new UnprocessedModel();
        $data = $model->getData();
        require 'View/unprocessed.php';
    }
}
?>
