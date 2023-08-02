<?php

require 'config/db.php';

//get form data when submit
if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //validate input values
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should have at least 8 characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please add your avatar";
    } else {
        // check passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if email already exists in database
            $user_check_query = "SELECT * FROM users WHERE email= '$email'";
            $user_check_result = mysqli_query($con, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Email already exist";
            } else {
                //work on avatar
                //rename the avatar
                $time = time(); //to make each image unique
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../public-images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    //make sure the image is not too large (1mb+)
                    if ($avatar['size'] < (1000000)) {
                        //upload the avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File size is too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "Invalid file type, should be png, jpg or jpeg";
                }
            }
        }
    }



    //redirect back to signup page if there is problem
    if (isset($_SESSION['add-user'])) {
        //pass form data back to signup
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // insert new user into users table
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";
        $insert_user_result = mysqli_query($con, $insert_user_query);

        if (!mysqli_errno($con)) {
            // redirect to manage page with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname has been added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-user.php');
        }
    }
} else {
    //if not, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
