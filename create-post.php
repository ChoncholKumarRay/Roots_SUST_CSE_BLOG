<?php

session_start();
$logged = false;

if (
    isset($_SESSION['user_id']) &&
    $_SESSION['status'] == "logged"
) {
    $logged = true;
}

if ($logged == false) {
    header("Location: ./index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Create Post - Roots</title>
</head>

<body>
    <?php
    include './include/main_menu.php';
    ?>

    <div class="post-center mt-4">
        <h3 class="mb-3">Write what's on your mind</h3>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-warning">
                <?php echo htmlspecialchars($_GET['error']) ?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['success']) ?>
            </div>
        <?php } ?>

        <form action="./include/create-post.inc.php" class="shadow p-3" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="content" class="form-label">Text</label>
                <textarea name="content" id="content" class="form-control text" name="content"></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Add Image (Optional)</label>
                <input type="file" class="form-control" name="cover_image">
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>

</body>

</html>