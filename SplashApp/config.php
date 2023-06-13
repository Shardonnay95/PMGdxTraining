<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "splashapp";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die('Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
