<?php
require 'config/db.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //fetch user from database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    //limit 1
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../public-images/' . $avatar_name;

        //delete image
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }
    //FOR LATER
    //Fetch all thumbnails of user's post and delete them






    //delete user form db
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($con, $delete_user_query);
    if (mysqli_errno($con)) {
        $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']} {$user['lastname']} '";
    } else {
        $_SESSION['delete-user-success'] = "'{$user['firstname']} {$user['lastname']} ' deleted successfully.";
    }
}
header('location: ' . ROOT_URL . 'admin/manage-user.php');
