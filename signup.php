<?php

session_start();

if (
    isset($_SESSION['user_id']) &&
    $_SESSION['status'] == "logged"
) {
    header("Location: ./index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Roots</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100 backdrop">

        <form class="shadow w-450 p-3 frontdrop" action="./include/signup.inc.php" method="post">

            <h4 class="display-4  fs-1">Create Account</h4><br>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['success']; ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Registration ID</label>
                <input type="text" class="form-control" name="reg_no">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label class="form-label">User name</label>
                <input type="text" class="form-control" name="username">
            </div>

            <div class=" mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="pwd">
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Student Status</label>
                <select name="user_type" id="user_type" class="form-control">
                    <option value="current_student" selected>Current Student</option>
                    <option value="alumni">Alumni</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Select your profile picture</label>
                <input type="file" class="form-control" name="profile_picture">
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>
            <p style="padding-top: 10px;">Already have an account?<a href="login.php">Login</a></p>

        </form>
    </div>
</body>

</html>