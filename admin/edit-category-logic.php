<?php
require 'config/db.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validate inputs
    if (!$title || !$description) {
        $_SESSION['edit-category'] = "Invalid inputs";
    } else {
        $query = "UPDATE categories SET title ='$title', description='$description' WHERE id=$id LIMIT 1 ";
        $result = mysqli_query($con, $query);

        if (mysqli_errno($con)) {
            $_SESSION['edit-category'] = "Couldn't update category";
        } else {
            $_SESSION['edit-category'] = "Category $title updated successfully.";
        }
    }
}
header('location: ' . ROOT_URL . 'admin/manage-category.php');
die();
