<?php
require 'config/db.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //update category_id to uncategorised 





    //FOR LATER
    //Fetch all thumbnails of user's post and delete them






    //delete user form db
    $query = "DELETE FROM categories WHERE id=$id";
    $result = mysqli_query($con, $query);
    $_SESSION['delete-category-success'] = "Category deleted successfully.";
}
header('location: ' . ROOT_URL . 'admin/manage-category.php');
