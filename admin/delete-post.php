<?php
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from db so we can delete image from public-image folder
    $query = "SELECT * FROM recipes WHERE id=$id";
    $result = mysqli_query($con, $query);

    // to make sure there is only 1 record
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc(($result));
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../public-images/' . $thumbnail_name;
        $video_name = $post['video'];
        $video_path = '../videos/' . $video_name;

        if ($thumbnail_path && $video_path) {
            unlink($thumbnail_path);
            unlink($video_path);

            //delete post from db
            $delete_post_query = "DELETE FROM recipes WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($con, $delete_post_query);

            if (!mysqli_errno($con)) {
                $_SESSION['delete-post-success'] = "Recipe Post Deleted Successfully.";
            }
        }
    }
}
header('location: '  . ROOT_URL . 'admin/');
die();
