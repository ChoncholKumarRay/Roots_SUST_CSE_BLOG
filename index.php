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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/post.css">
    <title>Roots</title>
</head>

<body>
    <?php
    include './include/main_menu.php';
    ?>
    <?php if ($logged == false) { ?>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="./image/alien.png" alt="Log in to see post" class="shadow m-3 centered-image mb-3">
        </div>
    <?php } else {

        include_once './include/db_conn.inc.php';
        include_once './include/functions.inc.php';

        $posts = getAllPost($pdo);
    ?>
        <div class="container mt-5">
            <div class="d-flex row justify-content-center">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-warning main-blog post-card">
                        <?php echo htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php } ?>
                <?php if ($posts != 0) { ?>
                    <!-- <h2>At least one post</h2> -->

                    <main class="main-blog">

                        <?php foreach ($posts as $post) {
                            /*Getting details about the post*/
                            $post_id = $post['post_id'];
                            $post_content = $post['content'];
                            $post_image = $post['cover_image'];
                            $post_creator = $post['user_id'];
                            $post_created_at = $post['created_at'];

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
                        ?>
                            <!-- Individual Post section begins here -->

                            <div class="post-card mb-5">

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

                                <?php if ($post_image != "default.jpg") { ?>
                                    <img src="./image/cover/<?php echo $post_image ?>" class="post-img" alt="cover_image">
                                <?php } ?>
                                <hr>
                                <?php
                                //Post like, comment details
                                $liked_by_cur_user = isLikedByUserID($pdo, $post_id, $user_id);
                                $total_like = likeCountByPostID($pdo, $post_id);
                                $total_comment = commentCountByPostID($pdo, $post_id);

                                ?>
                                <!-- Display Like Comment Section -->
                                <div class="d-flex justify-content-between">
                                    <div class="react-btns" style="padding-left: 15px; padding-bottom: 10px; margin-bottom:10px;">
                                        <?php if ($liked_by_cur_user) { ?>
                                            <i class="fa-solid fa-heart red-heart love-btn" post-id="<?php echo $post_id ?>" loved="1" aria-hidden="true"></i>
                                        <?php } else { ?>
                                            <i class="fa-regular fa-heart love-btn" post-id="<?php echo $post_id ?>" loved="0" aria-hidden="true"></i>
                                        <?php } ?>

                                        <text>Likes ( <span><?php echo $total_like ?> </span> ) &nbsp; &nbsp;</text>
                                        <a href="./post.php?post_id=<?php echo $post_id ?>#comments-thread">
                                            <i class="fa fa-comment" aria-hidden="true"></i> <text>Comments (
                                                <?php
                                                echo $total_comment;
                                                ?>
                                                ) </text>
                                        </a>
                                    </div>
                                </div>





                            </div>
                        <?php } ?>
                    </main>
                <?php } else { ?>

                    <div class="alert alert-warning">
                        No posts yet
                    </div>

                <?php } ?>
            </div>
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                $(".love-btn").click(function() {
                    var post_id = $(this).attr('post-id');
                    var loved = $(this).attr('loved');
                    var $span = $(this).siblings('text').find('span');
                    // console.log(post_id);
                    // console.log(liked);

                    if (loved == 1) {
                        $(this).attr('loved', '0');
                        $(this).removeClass('red-heart');
                        $(this).removeClass('fa-solid');
                        $(this).addClass('fa-regular');
                    } else {
                        $(this).attr('loved', '1');
                        $(this).removeClass('fa-regular');
                        $(this).addClass('fa-solid');
                        $(this).addClass('red-heart');
                    }
                    $span.load("include/like-unlike.php", {
                        post_id: post_id
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <?php } ?>

</body>

</html>