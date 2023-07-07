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
    <!-- <link rel="stylesheet" href="./summernote/summernote-lite.min.css"> -->

    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;500;600;700&family=Princess+Sofia&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
    <!-- <script src="./summernote/summernote-lite.min.js"></script> -->
    <!-- <script src="./js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> -->
    <!-- <script src="// cdn.tinymce.com/4/tinymce.min.js"></script> -->
    <script src="https://cdn.tiny.cloud/1/zkyfbdptnb28ra8ndvi6plhew0ise4afaii1wg87b5iw1pkq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,

            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: ' checklist numlist bullist indent outdent | bold italic underline strikethrough | undo redo  | align lineheight | removeformat',
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
    <!-- <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script> -->


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