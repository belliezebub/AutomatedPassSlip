<?php
require_once 'Config/Database.php';
require_once 'Model/PassSlipFormModel.php';

class PassSlipController {
    private $db;
    private $passSlip;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->passSlip = new PassSlip($this->db);
    }

    public function getTeachers() {
        $query = "SELECT id, firstname, lastname FROM usersprofile WHERE function = 'Teacher'";
        $result = $this->db->query($query);
        $teachers = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teachers[] = $row;
            }
        }

        return $teachers;
    }

    public function createPassSlip($data) {
        session_start();
        $this->passSlip->id = $_SESSION['user_id']; // Store requester's ID in 'id' column
        $this->passSlip->requester = $data['requester']; // Assuming 'requester' is the requester's data
        $this->passSlip->section = $data['section'];
        $this->passSlip->type = $data['type'];
        $this->passSlip->purpose = $data['purpose'];
        $this->passSlip->details = $data['details'];
        $this->passSlip->subjectTeacher = $data['subjectTeacher'];
        $this->passSlip->adviser = $data['adviser'];
        $this->passSlip->csd = $data['csd'];
        $this->passSlip->status = 'Subj. Teacher'; // Setting initial status

        if ($this->passSlip->create()) {
            return "Pass Slip submitted successfully!";
        } else {
            return "Failed to submit pass slip.";
        }
    }

    public function showForm() {
        $teachers = $this->getTeachers();
        require 'View/PassSlipForm.php';
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $this->createPassSlip($_POST);
            echo "<script>
                    alert('$message');
                    window.history.go(-2);
                  </script>";
        } else {
            $this->showForm();
        }
    }
}
?>
