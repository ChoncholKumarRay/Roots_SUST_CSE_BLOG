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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
                <!-- <h1>Got so many posts</h1> -->
                <?php if ($posts != 0) { ?>
                    <!-- <h2>At least one post</h2> -->

                    <main class="main-blog">

                        <?php foreach ($posts as $post) {
                            $creator_name = "Unknown User";
                            $creator_image = "default_user.jpg";
                            $creator_reg = "000";
                            $creator = getCreatorInfo($pdo, $post['user_id']);
                            if ($creator != 0) {
                                $creator_name = $creator['username'];
                                $creator_reg = $creator['reg_no'];
                                $creator_image = $creator['profile_picture'];
                            }
                        ?>
                            <!-- <h3>Here is one post</h3> -->

                            <div class="post-card mb-5">

                                <div class="post-profile-section">
                                    <img src="./image/profile/<?php echo $creator_image ?>" class="post-profile-section-img" alt="Profile Image">
                                    <div class="post-profile-info">
                                        <span class="post-profile-name"><?php echo $creator_name ?> &middot <span style="font-size: 12px; color: #999;"><?php echo $creator_reg ?></span></span>
                                        <span class="post-profile-time">Posted on <?php echo $post['created_at'] ?></span>
                                    </div>
                                </div>


                                <div class="post-text">
                                    <p>
                                        <?php echo $post['content'] ?>
                                    </p>
                                </div>

                                <?php if ($post['cover_image'] != "default.jpg") { ?>
                                    <img src="./image/cover/<?php echo $post['cover_image'] ?>" class="post-img" alt="cover_image">
                                <?php } ?>




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

    <?php } ?>

</body>

</html>