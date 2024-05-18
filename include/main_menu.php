<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../image/logo.png" alt="Logo" width="30" height="30" class="me-2"> <b><span style="color: #fff;">Roots</span></b>
        </a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/create-post.php">Create Post <i class="fa-regular fa-pen-to-square"></i></a>
                </li>
            </ul>

            <?php
            if ($logged) {
            ?>
                <ul class="navbar-nav">


                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <img src="../image/profile/<?php echo $_SESSION['profile_picture'] ?>" alt="Logo" width="30" height="30" class="dp"> <?= $_SESSION['username'] ?>
                        </a>
                    </li>

                    <li class="nav-link" style="color: #fff !important;">
                        |
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>

                </ul>

            <?php
            } else {
            ?>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../login.php">Login</a>
                    </li>

                    <li class="nav-link" style="color: #fff !important;">
                        |
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../signup.php">Signup</a>
                    </li>

                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>