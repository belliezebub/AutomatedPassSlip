<?php
class PassSlip {
    private $conn;
    private $table_name = "pass_slips";

    public $id; 
    public $requester;
    public $section;
    public $type;
    public $purpose;
    public $details;
    public $subjectTeacher;
    public $adviser;
    public $csd;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
        $this->status = 'Subj. Teacher'; // Set the default status
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id, requester, section, type, purpose, details, subjectTeacher, adviser, csd, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param(
                'isssssssss',
                $this->id,
                $this->requester,
                $this->section,
                $this->type,
                $this->purpose,
                $this->details,
                $this->subjectTeacher,
                $this->adviser,
                $this->csd,
                $this->status
            );

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
?>
