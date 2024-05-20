<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../index.php");
    exit;
}

session_start();

if (
    isset($_SESSION['user_id']) &&
    $_SESSION['username']
) {
    if (
        isset($_POST['content'])
        && isset($_FILES['cover_image'])
    ) {
        // Getting the post details and creator id
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $cover_image_name = $_FILES['cover_image']['name'];

        if (empty($content)) {
            $err = "Write some line in content!";
            header("Location: ../create-post.php?error=$err");
            exit;
        }


        // Unload contents that have photo too
        if ($cover_image_name != "") {
            $image_size = $_FILES['cover_image']['size'];
            $image_temp = $_FILES['cover_image']['tmp_name'];
            $error = $_FILES['cover_image']['error'];
            if ($error === 0) {
                if ($image_size > 3000000) {
                    $err = "This file is too large. Max size = 3MB";
                    header("Location: ../create-post.php?error=$err");
                    exit;
                } else {
                    $image_extension = pathinfo($cover_image_name, PATHINFO_EXTENSION);
                    $image_extension = strtolower($image_extension);
                    $allowed_extension = array('png', 'jpg', 'jpeg');
                    if (in_array($image_extension, $allowed_extension)) {
                        $upload_image_name = uniqid("cover_image-", false) . date('YmdHis') . '.' . $image_extension;

                        // $uuid = Uuid::uuid4()->toString();
                        // $upload_image_name="cover_image-".$uuid.$image_extension;

                        $upload_path = "../image/cover/" . $upload_image_name;
                        move_uploaded_file($image_temp, $upload_path);

                        try {
                            require_once './db_conn.inc.php';
                            $query = "INSERT INTO post(user_id, content, cover_image) VALUES(:posted_by, :post_content, :post_image); ";
                            $statement = $pdo->prepare($query);
                            $statement->bindParam(":posted_by", $user_id);
                            $statement->bindParam(":post_content", $content);
                            $statement->bindParam(":post_image", $upload_image_name);
                            $statement->execute();
                            $msg = "Successfully Created Post!";
                            header("Location: ../create-post.php?success=$msg");
                        } catch (PDOException $e) {
                            die("Fatal Error Happened: " . $e->getMessage());
                        }
                    } else {
                        $err = "You can't upload image of this type.";
                        header("Location: ../create-post.php?error=$err");
                        exit;
                    }
                }
            } else {
                $err = "Problem happened uploading this image";
                header("Location: ../create-post.php?error=$err");
                exit;
            }
            // echo $user_id;
            // echo "<br>";
            // echo $username;
            // echo "<br>";
            // echo $content;
            // echo "<br>";
            // echo $cover_image_name;
            // echo "<br>";
            // echo $image_size;
            // echo "<br>";
            // echo $image_temp;
        } else {
            //Upload just content
            echo "Upload just content";
            try {
                require_once './db_conn.inc.php';
                $query = "INSERT INTO post(user_id, content) VALUES(:posted_by, :post_content); ";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":posted_by", $user_id);
                $statement->bindParam(":post_content", $content);
                $statement->execute();
                $msg = "Successfully Created Post!";
                header("Location: ../create-post.php?success=$msg");
            } catch (PDOException $e) {
                die("Fatal Error Happened: " . $e->getMessage());
            }
        }
    } else {
        $err = "Content Not Found!";
        header("Location: ../create-post.php?error=$err");
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}
