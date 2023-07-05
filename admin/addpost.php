<?php include "partials/header.php";

// fetch categories from db
$query = "SELECT * FROM categories";
$categories = mysqli_query($con, $query);

//get back from data if form is invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
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
            <input type="text" name="body" value="<?= $body ?>" placeholder="Describe a little bit about your recipe">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
                <?php endwhile ?>

            </select>

            <!-- cooking time + Serving -->
            <input type="number" name="serving" value="<?= $serving ?>" placeholder="Serving (eg. 8)">
            <input type="text" name="preptime" value="<?= $preptime ?>" placeholder="Prep Time (eg. 30mins)">
            <input type="text" name="cookingtime" value="<?= $cookingtime ?>" placeholder="Cooking Time (eg.45mins)">

            <div id="wrap">
                <div class="my_box">
                    <div class="field_box">
                        <input type="text" name="ingredient[]" value="" placeholder="Add ingredients. (eg. 1 cup of flour.)">
                    </div>
                    <div class="button_box">
                        <button type="button" name="add" id="add" class="sign__btn" onclick="add_more()"><i class="uil uil-plus-square"></i></button>
                    </div>

                </div>
            </div>
            <input type="hidden" id="box_count" value="1">

            <div id="wrap">
                <div class="my_box">
                    <div class="field_box">
                        <input type="text" name="direction[]" value="" placeholder="Add directions. (eg. STEP1: Preheat the oven.)">

                    </div>
                    <div class="button_box">
                        <button type="button" name="add" id="add2" class="sign__btn" onclick="add_more2()"><i class="uil uil-plus-square"></i> </button>

                    </div>

                </div>
            </div>
            <input type="hidden" id="box_count" value="1">




            <!-- only show for admin -->
            <?php if (isset($_SESSION['user_is_admin'])) : ?>

                <div class=" form__control inline">
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


</section>

<!-- add/remove dynamically -->

<script src="jquery-1.4.1.min.js"></script>
<script>
    function add_more() {
        var box_count = jQuery("box_count").val();
        box_count++;
        jQuery("#box_count").val(box_count);
        jQuery("#wrap").append('<div class="my_box" id="box_loop_' + box_count + '"><div class="field_box"><input type="text" name="ingredient[]" value="<?= $ingredient ?>" placeholder="Add ingredients. (eg. 1 cup of flour.)"></div><div class="button_box"><button type="button" name="add" id="add" class="sign__btn" onclick=remove_more("' + box_count + '")><i class="uil uil-trash-alt"></i></button></div></div>');



    }

    function remove_more(box_count) {
        jQuery("#box_loop_" + box_count).remove();
        var box_count = jQuery("box_count").val();
        box_count--;
        jQuery("#box_count").val(box_count);

    }

    function add_more2() {
        var box_count = jQuery("box_count").val();
        box_count++;
        jQuery("#box_count").val(box_count);
        jQuery("#wrap").append('<div class="my_box" id="box_loop_' + box_count + '"><div class="field_box"><input type="text" name="ingredient[]" value="<?= $ingredient ?>" placeholder="Add direction. (eg. Step 1: Preheat the oven.)"></div><div class="button_box"><button type="button" name="add" id="add" class="sign__btn" onclick=remove_more2("' + box_count + '")><i class="uil uil-trash-alt"></i></button></div></div>');



    }

    function remove_more2(box_count) {
        jQuery("#box_loop_" + box_count).remove();
        var box_count = jQuery("box_count").val();
        box_count--;
        jQuery("#box_count").val(box_count);

    }
</script>


<?php include "../partials/footer.php"; ?>