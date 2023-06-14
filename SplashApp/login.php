<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE EmailAddress = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['id'] = $user['Id'];
        $_SESSION['username'] = $user['Username'];
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Splash - Login</title>
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
            width: 500px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            color: #715CF8;
            text-align: center;
            margin-bottom: 1em;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 95%;
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
            margin-top: 10px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
            color: #715CF8;
        }

        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login to Splash</h1>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </div>
</body>
</html>
