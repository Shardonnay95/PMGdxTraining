<?php
session_start();
require_once 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE EmailAddress = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        $_SESSION['id'] = $row['Id'];
        header('Location: home.php');
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with this email.";
}
$stmt->close();
?>
