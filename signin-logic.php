<?php
require 'config/db.php';

if (isset($_POST['submit'])) {
    //get the form dater
    $user_email = filter_var($_POST['user_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$user_email) {
        $_SESSION['signin'] = "Email Required.";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required.";
    } else {
        //fetch users from database
        $fetch_user_query = "SELECT * FROM users WHERE  email='$user_email'";
        $fetch_user_result = mysqli_query($con, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //convert record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare pw with the saved on in db
            if (password_verify($password, $db_password)) {
                //set session for acess control
                $_SESSION['user-id'] = $user_record['id'];
                //set session for no admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                //log user in
                header('location: ' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Please check your inputs.";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    //if any problem , redirect back to signin page
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . 'signin.php');
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}