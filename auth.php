<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, role, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $role, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['role'] = $role;
        header("Location: dashboard.html");
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
?>
