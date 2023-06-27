<?php
require 'config/db.php';

if (isset($_SESSION['submit'])) {
    $author_id = $_SESSION['user-id']; //to get a current logged in user
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $serving = filter_var($_POST['serving'], FILTER_SANITIZE_NUMBER_INT);
    $preptime = filter_var($_POST['preptime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cookingtime = filter_var($_POST['cookingtime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ingredient = filter_var($_POST['ingredient[]'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $direction = filter_var($_POST['direction[]'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select the category";
    } elseif (!$ingredient) {
        $_SESSION['add-post'] = "Enter ingredients";
    } elseif (!$direction) {
        $_SESSION['add-post'] = "Please enter directions";
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
        $thumbnail_tmp = $thumnail['tmp_name'];
        $thumbnail_destination_path = '../public-images/' . $thumnbnail_name;

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
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        // set is_featured of all post to 0 if this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($con, $zero_all_is_featured_query);
        }
        //insert post into database
        $query = "INSERT INTO posts (title, serving, prep_time, cook_time, ingredients, directions, thumbnail, category_id, author_id,is_featured) VALUES
        ('$title', '$serving', '$preptime', '$cookingtime','$ingredient', '$direction', '$thumbnail_name', $category_id, $author_id, $is_featured) ";
        $result = mysqli_query($con, $query);

        if (mysqli_errno($con)) {
            $_SESSION['add-post-sucess'] = "New post added successfully.";
            header('location: ' . ROOT_URL . '/admin');
            die();
        }
    }
}
header('location: ' . ROOT_URL . 'admin/add-post.php');
