<?php
session_start();
require_once 'config.php';

$firstname = $mysqli->real_escape_string($_POST['firstname']);
$lastname = $mysqli->real_escape_string($_POST['lastname']);
$username = $mysqli->real_escape_string($_POST['username']);
$email = $mysqli->real_escape_string($_POST['email']);
$password = $mysqli->real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

$sql = "INSERT INTO users (FirstName, LastName, EmailAddress, Username, Password) 
VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";

if ($mysqli->query($sql) === TRUE) {
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $mysqli->insert_id;
    header('Location: home.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>
