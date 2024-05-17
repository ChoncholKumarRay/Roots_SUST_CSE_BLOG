<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../signup.php");
    exit;
}


if (
    isset($_POST["reg_no"]) &&
    isset($_POST["email"]) &&
    isset($_POST["username"]) &&
    isset($_POST["pwd"]) &&
    isset($_POST["user_type"])
) {

    $reg_no = htmlspecialchars($_POST['reg_no']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $user_type = htmlspecialchars($_POST['user_type']);
    $profile_picture = $_FILES['profile_picture']['name'];
    echo "<script>console.log('{$profile_picture}');</script>";

    if (empty($reg_no)) {
        $err_msg = "Unsuccessful! Registration ID is required!";
        header("Location: ../signup.php?error=$err_msg");
        exit;
    } else if (empty($email)) {
        $err_msg = "Unsuccessful! Email is required!";
        header("Location: ../signup.php?error=$err_msg");
        exit;
    } else if (empty($username)) {
        $err_msg = "Unsuccessful! Username is required!";
        header("Location: ../signup.php?error=$err_msg");
        exit;
    } else if (empty($pwd)) {
        $err_msg = "Unsuccessful! Give a strong password!";
        header("Location: ../signup.php?error=$err_msg");
        exit;
    } else if (empty($user_type)) {
        $err_msg = "Hey! Are you a current student or alumni!";
        header("Location: ../signup.php?error=$err_msg");
        exit;
    } else {
        if ($profile_picture == "") {
            try {
                require_once './db_conn.inc.php';
                $query = "INSERT INTO users (reg_no, email, username, pwd, user_type) VALUES(:reg_no, :email, :username, :pwd, :user_type); ";
                $statement = $pdo->prepare($query);
                $statement->bindParam(":reg_no", $reg_no);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":pwd", $pwd);
                $statement->bindParam(":user_type", $user_type);
                $statement->execute();
                $msg = "Account created successfully!";
                header("Location: ../signup.php?success=$msg");
            } catch (PDOException $e) {
                die("Fatal Error Happened: " . $e->getMessage());
            }
        } else {
            $image_size = $_FILES['profile_picture']['size'];
            $image_temp = $_FILES['profile_picture']['tmp_name'];
            $error = $_FILES['profile_picture']['error'];

            if ($error === 0) {
                if ($image_size > 3000000) {
                    $err = "Your picture size is too large. Max size = 3 MB";
                    header("Location: ../signup.php?error=$err");
                    exit;
                } else {
                    $image_extension = pathinfo($profile_picture, PATHINFO_EXTENSION);
                    $image_extension = strtolower($image_extension);
                    $allowed_extension = array('png', 'jpg', 'jpeg');

                    if (in_array($image_extension, $allowed_extension)) {
                        $upload_image_name = uniqid("profile_picture-", false) . date('YmdHis') . '.' . $image_extension;

                        $upload_path = "../image/profile/" . $upload_image_name;
                        move_uploaded_file($image_temp, $upload_path);
                        try {
                            require_once './db_conn.inc.php';
                            $query = "INSERT INTO users (reg_no, email, username, pwd,profile_picture, user_type) VALUES(:reg_no, :email, :username, :pwd, :photo, :user_type); ";
                            $statement = $pdo->prepare($query);
                            $statement->bindParam(":reg_no", $reg_no);
                            $statement->bindParam(":email", $email);
                            $statement->bindParam(":username", $username);
                            $statement->bindParam(":pwd", $pwd);
                            $statement->bindParam(":photo", $upload_image_name);
                            $statement->bindParam(":user_type", $user_type);
                            $statement->execute();
                            $msg = "Account created successfully!";
                            header("Location: ../signup.php?success=$msg");
                        } catch (PDOException $e) {
                            die("Fatal Error Happened in Uploading Image: " . $e->getMessage());
                        }
                    } else {
                        $err = "Image type not allowable. Allowable: png, jpg, jpeg!";
                        header("Location: ../signup.php?error=$err");
                        exit;
                    }
                }
            } else {
                $err = "Problem happened while uploading your picture!";
                header("Location: ../signup.php?error=$err");
                exit;
            }
        }
    }
} else {
    header("Location: ../signup.php?error='Fill all the field correctly!'");
    exit;
}
