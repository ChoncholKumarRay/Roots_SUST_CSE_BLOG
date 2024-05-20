<?php

session_start();
$logged = false;

if (
    isset($_SESSION["username"]) &&
    isset($_SESSION["reg_no"]) &&
    isset($_SESSION["user_id"]) &&
    isset($_SESSION["profile_picture"])
) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
} else {
    $err = "Login Failed! Please Log into your account";
    header("Location: ../login.php?error=#$err");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/post.css">
    <title>Post Details</title>
</head>

<body>
    <?php
    include './include/main_menu.php';
    ?>
    <?php if (isset($_GET['post_id'])) {
        include "./include/db_conn.inc.php";
        include "./include/functions.inc.php";
        $post_id = $_GET['post_id'];
        $post = getPostbyID($pdo, $post_id);
        if ($post == 0) {
            echo "Getting no post";
            echo "Post_id == $post_id";
            //header("Location: ./index.php");
            exit;
        }
        // Post Details
        $post_content = $post['content'];
        $post_image = $post['cover_image'];
        $post_creator = $post['user_id'];
        $post_created_at = $post['created_at'];

        // Post Creator Info
        /*Default details about post creator*/
        $creator_name = "Unknown User";
        $creator_image = "default_user.jpg";
        $creator_reg = "000";
        $creator_type = "";
        $reg_color = "#999"; //By default silver color

        /*Getting details about the post creator*/
        $creator = getCreatorInfo($pdo, $post_creator);
        if ($creator != 0) {
            $creator_name = $creator['username'];
            $creator_reg = $creator['reg_no'];
            $creator_image = $creator['profile_picture'];
            $creator_type = $creator['user_type'];
            if ($creator_type == "alumni")
                $reg_color = "#D1B000"; //Golden color for alumni
        }

        // Comments Count
        $total_comments = commentCountByPostID($pdo, $post_id);
    ?>
        <div class="container mt-5">
            <div class="d-flex row justify-content-center">
                <!-- Show Error and Success Message while commenting -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger main-blog post-card" role="alert">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success main-blog post-card" role="alert">
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } ?>

                <!-- The post is showing here -->
                <main class="main-blog">
                    <div class="post-card mb-5" style="padding-bottom: 15px;">

                        <!-- Post Creator Details Section -->
                        <div class="post-profile-section">
                            <img src="./image/profile/<?php echo $creator_image ?>" class="post-profile-section-img" alt="Profile Image">
                            <div class="post-profile-info">
                                <span class="post-profile-name"><?php echo $creator_name ?> &middot <span style="font-size: 12px; color: <?php echo $reg_color ?>;"><?php echo $creator_reg ?></span></span>
                                <span class="post-profile-time">Posted on <?php echo formatDateTime($post_created_at) ?></span>
                            </div>
                        </div>
                        <div class="post-text">
                            <p>
                                <?php echo $post_content ?>
                            </p>
                        </div>


                        <!-- Handling Whether the post have an image -->
                        <?php if ($post_image != "default.jpg") { ?>
                            <img src="./image/cover/<?php echo $post_image ?>" class="post-img" alt="cover_image">
                        <?php } ?>
                        <hr>
                        <text style="padding-left: 15px; padding-bottom: 15px;"> <?php echo $total_comments ?> comments </text>
                        <hr>

                        <!-- Add comment form -->
                        <form action="./include/comment.inc.php" method="post" id="add-comment" style="padding: 15px; padding-top:0px; padding-bottom: 0px;">

                            <h5 class="mt-4 text-secondary">Add comment</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="comment">
                                <input type="text" class="form-control" name="post_id" value="<?php echo $post_id ?>" hidden>
                            </div>
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </form>
                        <hr>

                        <!-- Show all comments -->
                        <?php
                        $comments = getCommentsByPostID($pdo, $post_id);
                        // echo $comments;
                        if ($comments != 0) {
                            foreach ($comments as $comment) {
                                // Details about comment
                                $comment_text = $comment['content'];
                                $commented_at = $comment['commented_at'];
                                $commentor_id = $comment['user_id'];

                                //Details about commentor
                                $commentor = getCreatorInfo($pdo, $commentor_id);
                                $commentor_name = $commentor['username'];
                                $commentor_image = $commentor['profile_picture'];
                                $commentor_reg = $commentor['reg_no'];
                                $commentor_type = $commentor['user_type'];
                                $reg_color = "#999";
                                if ($commentor_type == "alumni")
                                    $reg_color = "#D1B000";

                        ?>
                                <!-- Show each comment -->
                                <div class="post-profile-section">
                                    <img src="./image/profile/<?php echo $commentor_image ?>" class="post-profile-section-img" alt="Commentor Image">
                                    <div class="post-profile-info">
                                        <span class="post-profile-name"><?php echo $commentor_name ?> &middot <span style="font-size: 12px; color: <?php echo $reg_color ?>;"><?php echo $commentor_reg ?></span></span>
                                        <span class="post-profile-time">Commented on <?php echo formatDateTime($commented_at) ?></span>
                                    </div>
                                </div>
                                <div class="comment-box-text">
                                    <?php echo $comment_text ?>
                                </div>
                            <?php }
                        } else { ?>
                            <p style="padding-left: 15px; padding-bottom:0px; margin-bottom:0px;">No Comments Yet. Be the first one...</p>
                        <?php }
                        ?>
                    </div>
                </main>
            </div>
        </div>
    <?php } else {
        header("Location: ./index.php");
        exit;
    } ?>
</body>

</html>