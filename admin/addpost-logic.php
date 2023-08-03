<?php
require 'config/db.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id']; //to get a current logged in user
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $serving = filter_var($_POST['serving'], FILTER_SANITIZE_NUMBER_INT);
    $preptime = filter_var($_POST['preptime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cookingtime = filter_var($_POST['cookingtime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ingredients = filter_var($_POST['ingredient'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $directions = filter_var($_POST['direction'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];
    $video = $_FILES['video'];
    $url = filter_var($_POST['url']);

    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Add a description.";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select the category";
    } elseif (!$ingredients) {
        $_SESSION['add-post'] = "Enter ingredients";
    } elseif (!$directions) {
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
    // Check if a video file is selected
    if ($video['name']) {
        // Rename the video file
        $time = time();
        $video_name = $time . $video['name'];
        $video_tmp = $video['tmp_name'];
        $video_destination_path = '../videos/' . $video_name;

        // Make sure file is a video
        $allowed_v_files = ['mp4', 'mov', 'avi', 'mkv'];
        $v_extension = strtolower(pathinfo($video_name, PATHINFO_EXTENSION));

        if (in_array($v_extension, $allowed_v_files)) {
            // Make sure video is not too big
            if ($video['size'] < 250_000_000) {
                // Upload video
                move_uploaded_file($video_tmp, $video_destination_path);
            } else {
                $_SESSION['add-post'] = "Video size is too big, should be less than 50mb.";
            }
        } else {
            $_SESSION['add-post'] = "File type error, should only be mp4, mov, avi, or mkv.";
        }
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

    $query = "INSERT INTO recipes (title, body, serving, preptime, cookingtime, thumbnail, ingredient, direction, category_id, author_id, is_featured, video, video_url) VALUES
              ('$title','$body', '$serving', '$preptime', '$cookingtime', '$thumbnail_name', '$ingredients', '$directions',  $category_id, $author_id, $is_featured, '$video_name','$url')";
    $result = mysqli_query($con, $query);

    if (mysqli_errno($con)) {
        $_SESSION['add-post-success'] = "New post added successfully.";
        header('location: ' . ROOT_URL . '/admin');
        die();
    }
}







header('location: ' . ROOT_URL . 'admin/addpost.php');
die();
