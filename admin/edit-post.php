<?php include "partials/header.php";

//fetch categories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($con, $category_query);

//fetch post data from db if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipes WHERE id=$id";
    $result = mysqli_query($con, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}


?>

<!-- <script src="https://cdn.tiny.cloud/1/zkyfbdptnb28ra8ndvi6plhew0ise4afaii1wg87b5iw1pkq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->

<!-- Page background -->
<style type="text/css">
    body {
        background-color: #4C5959;
    }

    h2 {
        text-align: center;
        padding-top: 60px;
    }
</style>




<section class="form_section">
    <h2>Edit Recipe</h2>
    <!-- <div class="form__image-r">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div> -->
    <div class="container form__section-container">

        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Recipe Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
                <?php endwhile ?>

            </select>

            <!-- cooking time + Serving -->
            <input type="number" name="serving" value="<?= $post['serving'] ?>" placeholder="Serving (eg. 8)">
            <input type="text" name="preptime" value="<?= $post['preptime'] ?>" placeholder="Prep Time (eg. 30mins)">
            <input type="text" name="cookingtime" value="<?= $post['cookingtime'] ?>" placeholder="Cooking Time (eg.45mins)">

            <!-- adding ingredients -->
            <textarea name="ingredient" rows=" 4" placeholder=" (eg. 1 cup of flour.)" id="mytextarea"></textarea>

            <!-- adding directions -->
            <textarea name="direction" rows="4" placeholder=" (eg. Pre heat the oven..)" id="mytextarea"></textarea>

            <!-- only show for admin -->
            <?php if (isset($_SESSION['user_is_admin'])) : ?>

                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured">
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>

            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>

            <button type="submit" name="submit" class="btn">Update Recipe</button>

        </form>

    </div>

</section>
<?php include "../partials/footer.php"; ?>