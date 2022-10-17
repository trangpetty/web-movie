<?php 
    include './configuration/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/movie.css">
    <link rel="stylesheet" href="../assets/slideshow.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/jquery.flipster.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <title>Disney Movie</title>
</head>
<body>
    <nav class="navbar bg-dark navbar-expand-sm p-1">
        <a class="navbar-brand ms-2 mt-1" style="max-width: 7%;" href="index.php">
            <img src="../assets/img/logo.png" alt="">
        </a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item px-3">
              <a class="nav-link text-white" href="movies.php">
                <b>MOVIES</b>
            </a>
            </li>
        
</nav>
        <div class="hero bg-dark">
            <div class="carousel">
                <ul>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/thor.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/super.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/shehulk.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/pinocchio.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/bighero.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/turning red.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/tangled.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="watch.php">
                            <img src="../assets/img/frozen2.jpg" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <script src="../assets/jquery.flipster.min.js">
            
        </script>
        <script>
            $('.carousel').flipster({
                style:'carousel',
                spacing: -0.3,
            })
        </script>