<?php
require 'config/db.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     if (!isset($_SESSION['ingredients'])) {
//         $_SESSION['ingredients'] = array();
//     }
//     if (!isset($_SESSION['directions'])) {
//         $_SESSION['directions'] = array();
//     }
// }


if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id']; //to get a current logged in user
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $serving = filter_var($_POST['serving'], FILTER_SANITIZE_NUMBER_INT);
    $preptime = filter_var($_POST['preptime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cookingtime = filter_var($_POST['cookingtime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $ingredients = filter_var($_POST['ingredient'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $directions = filter_var($_POST['direction'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Add a description.";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select the category";
        // } elseif (!$ingredients) {
        //     $_SESSION['add-post'] = "Enter ingredients";
        // } elseif (!$directions) {
        //     $_SESSION['add-post'] = "Please enter directions";
    } elseif (!$serving) {
        $_SESSION['add-post'] = "Please enter serving";
    } elseif (!$preptime) {
        $_SESSION['add-post'] = "Please enter the preparation time";
    } elseif (!$cookingtime) {
        $_SESSION['add-post'] = "Please enter cooking time";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail";
    } else {
        //work on thumbnail
        //rename the image
        $time = time(); //to make each name unique
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../public-images/' . $thumbnail_name;

        //make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            // make sure image is not too big (2mb+)
            if ($thumbnail['size'] < 2_000_000) {
                //upload thumbnail
                move_uploaded_file($thumbnail_tmp, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "File size is too big, should be less than 2mb.";
            }
        } else {
            $_SESSION['add-post'] = "File type error, should only be jpg,png or jpeg.";
        }
    }
    //redirect back with form data to add post page if error occurs
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/addpost.php');
        die();
    } else {
        // set is_featured of all post to 0 if this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE recipes SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($con, $zero_all_is_featured_query);
        }
        //insert post into database

        $query = "INSERT INTO recipes (title, body, serving, preptime, cookingtime, thumbnail, category_id, author_id,is_featured) VALUES
             ('$title','$body', '$serving', '$preptime', '$cookingtime', '$thumbnail_name', '$category_id', '$author_id', '$is_featured')";
        $result = mysqli_query($con, $query);
        $input_id = $con->insert_id;

        foreach ($_POST['ingredient'] as $key => $value) {
            if ($key != '') {
                $ingredient_query = "INSERT INTO ingredients(recipes_id,list)VALUES ('" . $input_id . "','" . $_POST['ingredient'][$key] . "')";
            }
        }

        foreach ($_POST['direction'] as $key => $value) {
            $ingredient_query = "INSERT INTO directions(recipes_id,list)VALUES ('" . $input_id . "','" . $_POST['direction'][$key] . "')";
        }

        if (mysqli_errno($con)) {
            $_SESSION['add-post-success'] = "New post added successfully.";
            header('location: ' . ROOT_URL . '/admin');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'admin/addpost.php');
die();
