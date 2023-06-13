<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

// Fetch posts from the database
$postsQuery = "SELECT posts.PostText, posts.PostTimeStamp, users.Username
               FROM posts
               INNER JOIN users ON posts.UserId = users.Id
               ORDER BY posts.PostTimeStamp DESC";
$stmt = $mysqli->prepare($postsQuery);

if (!$stmt) {
    die('Error: ' . $mysqli->error);
}

$stmt->execute();
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Splash</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700|Open+Sans&display=swap" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
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

        input[type="text"] {
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

        .post {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .post__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post__username {
            font-weight: bold;
        }

        .post__time {
            font-size: 0.8em;
        }

        .post__content {
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#createPostForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                var postText = $('#postText').val(); // Get the post text

                $.ajax({
                    type: 'POST',
                    url: 'create_post.php',
                    data: { postText: postText },
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#postText').val(''); // Clear the post text field
                            $('#postsContainer').prepend(response.postHtml); // Prepend the new post to the container
                        }
                    },
                    error: function() {
                        alert('An error occurred while creating the post.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <form id="createPostForm">
            <input type="text" id="postText" placeholder="What's on your mind?" required>
            <button type="submit">Post</button>
        </form>
        
        <h2>Recent Posts:</h2>
        <div id="postsContainer">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="post__header">
                        <span class="post__username"><?php echo htmlspecialchars($post['Username']); ?></span>
                        <span class="post__time"><?php echo htmlspecialchars($post['PostTimeStamp']); ?></span>
                    </div>
                    <div class="post__content"><?php echo htmlspecialchars($post['PostText']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
