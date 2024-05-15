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
    }
} else {
    header("Location: ../signup.php?error='Fill all the field correctly!'");
    exit;
}
