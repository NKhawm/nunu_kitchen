<?php
require 'config/db.php';

//fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar,id FROM users WHERE id=$id";
    $result = mysqli_query($con, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Nunu'sKitchen: Where Food Lovers Share Their Culinary Creations">
    <meta name="description" content="Discover Myanmar tradtional recipes and a world of delightful flavors and culinary inspirations at NunuKitchen, a user-generated website where food enthusiasts come together to share their favorite recipes, cooking tips, and gastronomic adventures.">

    <!-- css -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/main.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;500;600;700&family=Princess+Sofia&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?= ROOT_URL ?>images/favicon.ico">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/print.css" media="print">
    <!-- <script src="https://cdn.tiny.cloud/1/zkyfbdptnb28ra8ndvi6plhew0ise4afaii1wg87b5iw1pkq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <link rel="stylesheet" type="text/css" href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
    <script src="https://cdn.tiny.cloud/1/zkyfbdptnb28ra8ndvi6plhew0ise4afaii1wg87b5iw1pkq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.textarea',
            menubar: false,

            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'numlist bullist indent outdent | bold italic underline strikethrough | undo redo  | align lineheight | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
    </script>


    <title>NuNu's Kitchen Recipes</title>
</head>

<body>

    <nav>
        <div class="container nav__container">
            <button id="open__nav-btn"><i class="uil uil-list-ul"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>

            <a href="<?= ROOT_URL ?>index.php" class="nav__logo">
                <img class="logo" src="<?= ROOT_URL ?>/images/logo.png" alt="brand logo"></a>


            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>recipe.php">Recipes</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>

                <?php if (isset($_SESSION['user-id'])) :  ?>
                    <li class="nav__profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'public-images/' . $avatar['avatar']; ?>">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/index.php?id=<?= $avatar['id'] ?>">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>favourites.php?id=<?= $_SESSION['user-id'] ?>">Saved Recipes</a></li>
                            <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">Signin </a></li>
                <?php endif ?>
            </ul>

            <?php include 'transalate.php'; ?>




        </div>



    </nav>
    <!======End of nav=====>