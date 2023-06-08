<?php
require 'config/db.php';

//fetch current user from database
// if(isset($_SESSION['user_id'])){
//     $id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
//     $query= "SELECT avatar FROM users WHERE id=$id";
//     $result= mysqli_query($con, $query);
//     $avatar= mysqli_fetch_assoc($result);
// }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/main.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script> -->
    <!-- <script src="https://kit.fontawesome.com/9346465f4f.js" crossorigin="anonymous"></script> -->
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;500;600;700&family=Princess+Sofia&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">

    <title>NuNu's Kitchen Recipes</title>
</head>

<body>
    <nav>
        <div class="container nav__container">
            <!-- hamburger -->
            <!-- <span class="burger" onclick="Menu(this)"><i class="uil uil-bars"></i></span> -->
            <button id="open__nav-btn"><i class="uil uil-align"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>


            <a href="<?= ROOT_URL ?>index.php" class="nav__logo"><img class="logo" src="<?= ROOT_URL ?>/images/logo.png" alt="brand logo"></a>
            <?php include 'partials/create-button.php'; ?>

            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>recipe.php">Recipes</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <!-- <li><a href="<?= ROOT_URL ?>create_recipe.php">+ Create </a></li> -->

                <li class="nav__profile">
                    <div class="avatar"><img src="./images/profilepic.png"> </div>

                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </nav>
    <!======End of nav=====>