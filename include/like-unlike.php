<?php

session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['username']) &&
    isset($_POST['post_id'])
) {
    include "./db_conn.inc.php";
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $username = $_SESSION['username'];
    // echo "<script>console.log('{$post_id}');</script>";
    // echo "<script>console.log('{$username}');</script>";
    if (empty($post_id)) {
        $err = "ERROR";
        echo $err;
    } else {
        try {
            $query = "SELECT * FROM post_like WHERE post_id = :post_id AND user_id = :viewer;";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":post_id", $post_id);
            $statement->bindParam(":viewer", $user_id);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                // User already liked the post. Now unlike it.
                $query = "DELETE FROM post_like WHERE post_id = :post_id AND user_id = :viewer;";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":post_id", $post_id);
                $statement->bindParam(":viewer", $user_id);
                $statement->execute();
            } else {
                // Add like to the post
                $query = "INSERT INTO post_like (user_id, post_id) VALUES(:viewer, :post_id);";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":post_id", $post_id);
                $statement->bindParam(":viewer", $user_id);
                $statement->execute();
            }
        } catch (PDOException $e) {
            die("Fatal Error: " . $e->getMessage());
        }
        $sql = "SELECT * FROM post_like
        WHERE post_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$post_id]);
        if ($stmt->rowCount() >= 0) echo $stmt->rowCount();
        else echo "...";
    }
} else {
    $err = "...";
    echo $err;
}
