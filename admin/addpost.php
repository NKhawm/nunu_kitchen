<?php include "partials/header.php";

// fetch categories from db
$query = "SELECT * FROM categories";
$categories = mysqli_query($con, $query);

//get back from data if form is invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$serving = $_SESSION['add-post-data']['serving'] ?? null;
$preptime = $_SESSION['add-post-data']['preptime'] ?? null;
$cookingtime = $_SESSION['add-post-data']['cookingtime'] ?? null;
$ingredient = $_SESSION['add-post-data']['ingredient'] ?? null;
$direction = $_SESSION['add-post-data']['direction'] ?? null;

//delete form data session
unset($_SESSION['add-post-data']);


?>

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


<section class="form_section ">
    <h2>Add a Recipe</h2>

    <!-- <div class="form__image-r">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div> -->
    <!-- adding ingredients -->

    <!-- <div class="container form__section-container"> -->
    <div class="container">
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>


        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/addpost-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Recipe Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
                <?php endwhile ?>

            </select>

            <!-- cooking time + Serving -->
            <input type="number" name="serving" value="<?= $serving ?>" placeholder="Serving (eg. 8)">
            <input type="text" name="preptime" value="<?= $preptime ?>" placeholder="Prep Time (eg. 30mins)">
            <input type="text" name="cookingtime" value="<?= $cookingtime ?>" placeholder="Cooking Time (eg.45mins)">
            <label for="Add Ingredients">Add Ingredients</label>
            <textarea name="ingredient" value="<?= $ingredient ?>" id="" rows="4" placeholder=" (eg. 1 cup of flour.)"></textarea>

            <!-- adding directions -->
            <label for="Add Directions">Add Directions</label>
            <textarea name="direction" value="<?= $direction ?>" id="" rows="4" placeholder=" (eg. Pre heat the oven..)"></textarea>


            <!-- only show for admin -->
            <?php if (isset($_SESSION['user_is_admin'])) : ?>

                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured">
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>

            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>

            <button type="submit" name="submit" class="btn button">+ Submit Recipe</button>

        </form>

    </div>
    <!-- <div id="textarea__container">
        <label for="Add Ingredients">Add Ingredients</label>
        <textarea name="ingredient" value="<?= $ingredient ?>" id="" rows="4" placeholder="Ingredients (eg. 1 cup of flour.)"></textarea>

        
        <label for="Add Directions">Add Directions</label>
        <textarea name="direction" value="<?= $direction ?>" id="" rows="4" placeholder="Directions (eg. Pre heat the oven..)"></textarea>
    </div> -->

</section>
<?php include "../partials/footer.php"; ?>