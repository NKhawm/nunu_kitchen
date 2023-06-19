<?php

require 'config/db.php';

//get signup form data when signed up
if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    //validate input values
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should have at least 8 characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add your avatar";
    } else {
        // check passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if email already exists in database
            $user_check_query = "SELECT * FROM users WHERE email= '$email'";
            $user_check_result = mysqli_query($con, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Email already exist";
            } else {
                //work on avatar
                //rename the avatar
                $time = time(); //to make each image unique
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'public-images/' . $avatar_name;

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
                        $_SESSION['signup'] = "File size is too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    //redirect back to signup page if there is problem
    if (isset($_SESSION['signup'])) {
        //pass form data back to signup
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // insert new user into users table
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
        $insert_user_result = mysqli_query($con, $insert_user_query);

        if (!mysqli_errno($con)) {
            // redirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please log in";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    //if not, bounce back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
