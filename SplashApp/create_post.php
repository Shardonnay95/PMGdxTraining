<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postText = trim($_POST["postText"]);
    $userId = $_SESSION['id'];

    if (!empty($postText)) {
        $insertQuery = "INSERT INTO posts (PostText, UserId) VALUES (?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("si", $postText, $userId);

        if ($stmt->execute()) {
            $postId = $stmt->insert_id;

            // Retrieve the newly created post from the database
            $selectQuery = "SELECT posts.PostText, posts.PostTimeStamp, users.Username
                            FROM posts
                            INNER JOIN users ON posts.UserId = users.Id
                            WHERE posts.Id = ?";
            $stmt = $mysqli->prepare($selectQuery);
            $stmt->bind_param("i", $postId);
            $stmt->execute();
            $result = $stmt->get_result();
            $post = $result->fetch_assoc();

            $postHtml = '
                <div class="post">
                    <div class="post__header">
                        <span class="post__username">' . htmlspecialchars($post['Username']) . '</span>
                        <span class="post__time">' . htmlspecialchars($post['PostTimeStamp']) . '</span>
                    </div>
                    <div class="post__content">' . htmlspecialchars($post['PostText']) . '</div>
                </div>';

            $response = array(
                'status' => 'success',
                'postHtml' => $postHtml
            );
            echo json_encode($response);
        } else {
            $response = array('status' => 'error');
            echo json_encode($response);
        }

        $stmt->close();
    }
}
?>
