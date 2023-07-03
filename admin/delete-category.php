<?php
require 'config/db.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //update category_id to uncategorised 

    //Fetch all thumbnails of user's post and delete them
    $update_query = "UPDATE recipes SET category_id=6 WHERE category_id=$id";
    $update_result = mysqli_query($con, $update_query);

    if (!mysqli_errno($con)) {
        //delete category
        //delete user form db
        $query = "DELETE FROM categories WHERE id=$id";
        $result = mysqli_query($con, $query);
        $_SESSION['delete-category-success'] = "Category deleted successfully.";
    }
}
header('location: ' . ROOT_URL . 'admin/manage-category.php');
