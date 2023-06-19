<?php
require 'config/db.php';

$user_email = $_SESSION['signin-data']['user_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>
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

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success'])
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>

                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin'])
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <input type="text" name="user_email" value="<?= $user_email ?>" placeholder="Email">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Password">

                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account with us? <a href="signup.php">Sign Up </a>here.</small>

            </form>

        </div>
        <div class="form__image">

            <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
        </div>
    </section>
</body>

</html>