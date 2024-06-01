<?php
class UserProfileModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getUserProfile($userId) {
        $query = "SELECT * FROM usersprofile WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProfilePicture($userId, $filePath) {
        $query = "UPDATE usersprofile SET profile_picture = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }
        $stmt->bind_param('si', $filePath, $userId);
        return $stmt->execute();
    }
}
?>
