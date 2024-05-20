<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../login.php");
    exit;
}

if (
    isset($_POST["reg_no"]) &&
    isset($_POST["pwd"])
) {

    $reg_no = htmlspecialchars($_POST['reg_no']);
    $pwd = htmlspecialchars($_POST['pwd']);

    if (empty($reg_no)) {
        $err_msg = "Give your Registration ID";
        header("Location: ../login.php?error=$err_msg");
        exit;
    } else if (empty($pwd)) {
        $err_msg = "Insert your Password";
        header("Location: ../login.php?error=$err_msg");
        exit;
    } else {
        try {
            require_once './db_conn.inc.php';
            $query = "SELECT * FROM users WHERE reg_no = :reg_id;";
            $statement = $pdo->prepare($query);
            $statement->bindParam(":reg_id", $reg_no);
            $statement->execute();

            // Getting the user detals associated with the registration no
            if ($statement->rowCount() == 1) {

                $user = $statement->fetch();

                $username =  $user['username'];
                $user_id = $user['user_id'];
                $db_pass = $user['pwd'];
                $profile_picture = $user['profile_picture'];

                if ($db_pass == $pwd) {
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['reg_no'] = $reg_no;
                    $_SESSION['username'] = $username;
                    $_SESSION['profile_picture'] = $profile_picture;
                    $_SESSION['status'] = "logged"; // Just for a global variable
                    header("Location: ../index.php");
                    exit;
                } else {

                    $err_msg = "Incorrect Registration ID and Password!";
                    header("Location: ../login.php?error=$err_msg");
                    exit;
                }
            } else {
                $err_msg = "Incorrect Registration ID and Password!";
                header("Location: ../login.php?error=$err_msg");
                exit;
            }
        } catch (PDOException $e) {
            die("Fatal Error Happened: " . $e->getMessage());
        }
    }
} else {
    header("Location: ../login.php?error='Fill all the field correctly!'");
    exit;
}
