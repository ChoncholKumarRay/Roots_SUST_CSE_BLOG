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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>About</title>
</head>

<body>
    <?php
    include './include/main_menu.php';
    ?>
    <div class="container text-center mt-3">
        <h1>About Us</h1>
        <h2 style="text-align: left;">Project Goal</h2>
        <h4 class="text-muted" style="text-align: justify; line-height: 1.5;">Our proposed project aims to develop a social networking platform for the students and alumni of SUST CSE Department. This platform will serve as a hub for current students and alumni to connect, share experiences, and stay updated on departmental news and events. Users will be able to create accounts using their unique Registration IDs, Username and Password, Log in to the site, and post contents (both text and images). Other users will see the post on their feed. Also they will have the ability to like, and comment on posts. There will be an admin panel to manage the users. The platform will feature an intuitive admin panel enabling efficient management of users, posts, and comments, ensuring a safe and engaging digital environment. Admin panel will be empowered to add and delete any users, post or comments directly.Moreover, Through this innovative platform, we aim to cultivate a thriving online community, enriching the academic and professional journeys of all its members.
        </h4>
        <hr>
        <h2 class="mt-4">Our Team</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <div class="col">
                <div class="card">
                    <img src="./image/dev/chonchol_profile.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">Chonchol Kumar Ray</h4>
                        <h5 class="card-text">2020331072</h5>
                    </div>
                    <div class="d-flex justify-content-evenly p-4">
                        <a href="https://www.linkedin.com/in/chonchol-kumar-ray/" target="_blank" class="icon-button">
                            <i class="bi bi-linkedin"></i></a>
                        <a href="https://github.com/ChoncholKumarRay" target="_blank" class="icon-button">
                            <i class="bi bi-github"></i> </a>
                        <a href="mailto:fusitivechonchol@gmail.com" target="_blank" class="icon-button">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="./image/dev/default_user.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">Sumaiya Ali Shafa</h4>
                        <h5 class="card-text">2020331022</h5>
                    </div>
                    <div class="d-flex justify-content-evenly p-4">
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-linkedin"></i></a>
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-github"></i> </a>
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="./image/dev/default_user.jpg" class="card-img-top" alt="Samantha">
                    <div class="card-body">
                        <h4 class="card-title">Sayeda Sazia Kalam</h4>
                        <h5 class="card-text">2020331054</h5>
                    </div>
                    <div class="d-flex justify-content-evenly p-4">
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-linkedin"></i></a>
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-github"></i> </a>
                        <a href="" target="_blank" class="icon-button">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>