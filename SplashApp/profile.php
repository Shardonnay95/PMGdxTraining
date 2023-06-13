<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// Fetch user details from the database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission and update the user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);

    // Validate email and password
    $emailRegex = "/^\S+@\S+\.\S+$/";
    $passwordRegex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";  // Minimum eight characters, at least one letter and one number

    $errors = [];

    if (!preg_match($emailRegex, $email)) {
        $errors[] = "Invalid email address";
    }

    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
        if (!preg_match($passwordRegex, $password)) {
            $errors[] = "Invalid password. Password must be at least 8 characters long and contain at least one letter and one number.";
        }
    }

    if (empty($errors)) {
        // Update user details in the database
        $updateQuery = "UPDATE users SET FirstName = ?, LastName = ?, Username = ?, EmailAddress = ? WHERE id = ?";
        $stmt = $mysqli->prepare($updateQuery);
        $stmt->bind_param("ssssi", $firstName, $lastName, $username, $email, $id);
        $stmt->execute();

        // Redirect back to the profile page with a success message
        $_SESSION['success'] = "Your profile has been updated successfully.";
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Splash - Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700|Open+Sans&display=swap" rel="stylesheet">
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: 'Open Sans', sans-serif;
            color: #545454;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-top: 30px;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            color: #715CF8;
            text-align: center;
            margin-bottom: 1em;
        }

        form {
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #545454;
        }

        button {
            display: inline-block;
            padding: 10px;
            background-color: #715CF8;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
        }

        .success-message {
            color: green;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #715CF8;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Profile</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="profile.php" method="POST">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>

            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($user['LastName']); ?>" required>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>

            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['EmailAddress']); ?>" required>

            <label for="password">New Password (optional)</label>
            <input type="password" name="password" id="password">

            <button type="submit">Update Profile</button>
        </form>

        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
