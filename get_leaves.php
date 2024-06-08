<?php
include 'db_config.php';

$sql = "SELECT user_id, leave_type, start_date, end_date FROM leave_requests WHERE status = 'approved'";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['leave_type'],
        'start' => $row['start_date'],
        'end' => date('Y-m-d', strtotime($row['end_date'] . ' +1 day')) // FullCalendar expects the end date to be exclusive
    ];
}

echo json_encode($events);
?>
