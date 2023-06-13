<!DOCTYPE html>
<html>
<head>
    <title>Create Account - Splash</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700|Open+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            color: #545454;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            color: #715CF8;
            text-align: center;
            margin-bottom: 1em;
        }

        input {
            margin-bottom: 1em;
            padding: 0.5em;
            border-radius: 5px;
            border-color: #545454;
            color: #545454;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        button {
            padding: 0.5em 1em;
            border-radius: 5px;
            border-color: #9584FF;
            background-color: #715CF8;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

        p {
            text-align: center;
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create new Account</h1>
        <form action="create_account_handler.php" method="POST">
            <input type="text" name="firstname" placeholder="Enter your First Name" required>
            <input type="text" name="lastname" placeholder="Enter your Last Name" required>
            <input type="text" name="username" placeholder="Enter your Username" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required minlength="8">
            <button type="submit">Sign Up</button>
        </form>
        <p>Already Registered? <a href="login.php">Log in here</a></p>
    </div>
</body>
</html>
