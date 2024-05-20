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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>About</title>
</head>

<body>
    <?php
    include './include/main_menu.php';
    ?>
    <div class="abt-container">
        <header>
            <h1>About Us</h1>
            <p class="tagline" style="padding-top: 25px;">We are Team Chaos Trio from SUST CSE-20. This is our project for Database System Lab (Course Code- CSE 334)</p>
        </header>
        <section class="about-section">
            <h2>Our Aim</h2>
            <p>
                Our aim was to develop a social networking platform for the students and alumni of the SUST CSE
                Department. This platform will serve as a hub for current students and alumni of SUST CSE to connect,
                share experiences, and stay updated on departmental news and events.
            </p>
        </section>
        <section class="features-section">
            <h2>Key Features</h2>
            <ul>
                <li>Users will be able to create accounts using their unique Registration IDs, Username, and Password.
                </li>
                <li>Log in to the site using Registration ID and Password.</li>
                <li>Only logged-in users can view and create posts. A post can contain both text and images.</li>
                <li>Other users who are logged in can see the post on their feed.</li>
                <li>All users have the ability to like and comment on any posts.</li>
            </ul>
        </section>
        <section class="future-section">
            <h2>Future Development</h2>
            <ul>
                <li>There will be an admin panel to manage the users, posts, and comments.</li>
                <li>Admin panel will be empowered to add and delete any users, posts, or comments directly.</li>
                <li>Improve the security of the website.</li>
            </ul>
        </section>
        <section class="technology-section">
            <h2>Used Technology</h2>
            <ul>
                <li>Front-end: <i class="fa-brands fa-html5" style="color: #ed333b;"></i> HTML, <i class="fa-brands fa-css3" style="color: #1c71d8;"></i> CSS, <i class="fa-brands fa-js" style="color: #f5c211;"></i> JavaScript</li>
                <li>Back-end: <i class="fa-brands fa-php" style="color: #c061cb;"></i> PHP</li>
            </ul>
        </section>

        <!-- Team member details start here -->
        <h2>Our Team</h2>
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