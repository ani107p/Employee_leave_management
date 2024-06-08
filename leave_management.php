<?php
include 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO leave_requests (user_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $leave_type, $start_date, $end_date, $reason);

    if ($stmt->execute()) {
        echo "Leave request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
