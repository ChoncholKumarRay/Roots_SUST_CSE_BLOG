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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Roots</title>
</head>

<body>

    <?php

    include './include/main_menu.php';

    ?>
    <div>
        <h2>This is the index page</h2>
        <h4>Current User Registration ID: <?php echo $_SESSION['reg_no'] ?></h4>
        <h4>Current User Username: <?php echo $_SESSION['username'] ?></h4>
        <h4>Current User User ID: <?php echo $_SESSION['user_id'] ?></h4>
        <h4>Current User Profile Picture: <?php echo $_SESSION['profile_picture'] ?></h4>

    </div>

    <?php

    ?>


</body>

</html>