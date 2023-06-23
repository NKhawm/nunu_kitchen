<?php
require 'config/db.php';

if (isset($_POST['submit'])) {
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-category'] = "Enter title.";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Enter description.";
    }

    //redirect back to add category page with form data if there is invalid input
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        //INSERT DATA
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($con, $query);
        if (mysqli_errno($con)) {
            $_SESSION['add-category'] = "Couldn't add category.";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = " $title category added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }
    }
}
