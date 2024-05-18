<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: ../index.php");
    exit;
}
session_start();

if (
    isset($_SESSION['user_id']) &&
    $_SESSION['username']
) {
    if (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user_id'];

        if (empty($comment)) {
            $err = "Write a comment on the box!";
            header("Location: ../post.php?error=$err&post_id=$post_id#comments-thread");
            exit;
        } else {
            try {
                include "./db_conn.inc.php";
                $query = "INSERT INTO comment (post_id, user_id, content) VALUES (:post_id, :user_id, :comment);";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":post_id", $post_id);
                $statement->bindParam(":user_id", $user_id);
                $statement->bindParam(":comment", $comment);
                $status = $statement->execute();
                if ($status) {
                    $msg = "Commented Successfully!";
                    header("Location: ../post.php?success=$msg&post_id=$post_id#comments-thread");
                    exit;
                } else {
                    $err = "Unexpected Error happened!";
                    header("Location: ../post.php?error=$err&post_id=$post_id#comments-thread");
                    exit;
                }
            } catch (PDOException $e) {
                die("Fatal Error happened while commenting" . $e->getMessage());
            }
        }
    } else {
        $err = "Error occured while commenting";
        header("Location: ../index.php?error=$err");
        exit;
    }
} else {
    $err = "You must log in to comment!";
    header("Location: ../login.php?error=$err");
    exit;
}
