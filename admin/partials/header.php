<?php
require 'config/db.php';

// //fetch current user from database
// if (isset($_SESSION['user-id'])) {
//     $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
//     $query = "SELECT avatar FROM users WHERE id=$id";
//     $result = mysqli_query($con, $query);
//     $avatar = mysqli_fetch_assoc($result);
// }
//check login status
if (!isset($_SESSION['user-id'])) {
    header('location:' . ROOT_URL . 'signin.php');
}

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
    <script src="// cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/zkyfbdptnb28ra8ndvi6plhew0ise4afaii1wg87b5iw1pkq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
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
            <!-- hamburger -->
            <!-- <span class="burger" onclick="Menu(this)"><i class="uil uil-bars"></i></span> -->
            <button id="open__nav-btn"><i class="uil uil-align"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>


            <a href="<?= ROOT_URL ?>index.php" class="nav__logo"><img class="logo" src="<?= ROOT_URL ?>/images/logo.png" alt="brand logo"></a>


            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>recipe.php">Recipes</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user-id'])) :  ?>
                    <li class="nav__profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . '../public-images/' . $avatar['avatar']; ?>">
                        </div>

                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>create_recipe.php">+ Create </a></li>
                <?php endif ?>



            </ul>

        </div>
    </nav>
    <!======End of nav=====>