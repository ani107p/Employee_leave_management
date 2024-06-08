<?php
include 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Existing leave request submission code...

    // Leave approval/rejection
    if (isset($_POST['action']) && $_POST['action'] == 'approve' || $_POST['action'] == 'reject') {
        $leave_id = $_POST['leave_id'];
        $status = $_POST['action'] == 'approve' ? 'approved' : 'rejected';
        $comment = $_POST['comment'];

        $sql = "UPDATE leave_requests SET status = ?, manager_comment = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $status, $comment, $leave_id);

        if ($stmt->execute()) {
            echo "Leave request $status successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
