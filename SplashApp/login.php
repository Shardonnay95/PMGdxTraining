<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = trim($_POST["firstName"]);
        $lastName = trim($_POST["lastName"]);
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);

        if (!empty($firstName) && !empty($lastName) && !empty($username) && !empty($email)) {
            $update_query = "UPDATE users SET FirstName = ?, LastName = ?, Username = ?, EmailAddress = ? WHERE id = ?";
            $stmt = $mysqli->prepare($update_query);
            $stmt->bind_param("ssssi", $firstName, $lastName, $username, $email, $id);
            $stmt->execute();
            header("Location: profile.php");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Splash - Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Your Profile</h1>
        <form action="login.php" method="POST">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo $user['FirstName'] ?>" required>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo $user['LastName'] ?>" required>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $user['Username'] ?>" required>
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email" value="<?php echo $user['EmailAddress'] ?>" required>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
