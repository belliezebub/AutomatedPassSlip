<?php
class TaskCount {
    private $mysqli;
    private $userId;
    private $firstname;

    public function __construct($mysqli, $userId, $firstname) {
        $this->mysqli = $mysqli;
        $this->userId = $userId;
        $this->firstname = $firstname;
    }

    public function countPendingTasks() {
        $sql = "SELECT COUNT(*) as count FROM pass_slips 
                WHERE (subjectTeacher = ? AND status = 'Subj. Teacher') 
                   OR (adviser = ? AND status = 'Adviser') 
                   OR (csd = ? AND status = 'csd')";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->mysqli->error);
        }
        $stmt->bind_param('sss', $this->firstname, $this->firstname, $this->firstname);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    public function countUnprocessedTasks() {
        $sql = "SELECT COUNT(*) as count FROM pass_slips 
                WHERE id = ? AND status NOT IN ('rejected', 'approved')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $this->userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    public function countCompletedTasks() {
        $sql = "SELECT COUNT(*) as count FROM pass_slips 
                WHERE id = ? AND status IN ('rejected', 'approved')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $this->userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }
}
?>
