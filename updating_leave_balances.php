if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Existing leave request submission and approval/rejection code...

    if (isset($_POST['action']) && $_POST['action'] == 'approve') {
        $leave_id = $_POST['leave_id'];
        $user_id = $_POST['user_id'];
        $leave_type = $_POST['leave_type'];
        $start_date = new DateTime($_POST['start_date']);
        $end_date = new DateTime($_POST['end_date']);
        $interval = $start_date->diff($end_date);
        $days = $interval->days + 1;  // Assuming inclusive dates

        $sql = "UPDATE leave_balances SET balance = balance - ? WHERE user_id = ? AND leave_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $days, $user_id, $leave_type);

        if ($stmt->execute()) {
            echo "Leave balance updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
