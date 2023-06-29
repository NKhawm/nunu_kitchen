<?php include "partials/header.php";

// fetch categories from db
$query = "SELECT * FROM categories";
$categories = mysqli_query($con, $query);



?>

<!-- Page background -->
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>

<!-- J query for adding individual ingredient
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var ingredientCount = 1;

        $('#add__ingredient').click(function() {
            ingredientCount++;
            var ingredientField = '<div class="ingredient"><input type="text" name="ingredient" placeholder="Ingredient ' + ingredientCount + '"><button class="removeIngredient" type="button">Remove</button></div>';
            $('#ingredient__container').append(ingredientField);
        });

        $(document).on('click', '.removeIngredient', function() {
            $(this).parent().remove();
            ingredientCount--;
        });
    });

    $(document).ready(function() {
        var directionCount = 1;

        $('#add__direction').click(function() {
            directionCount++;
            var directionField = '<div class="direction"><input type="text" name="direction" placeholder="Step ' + directionCount + '"><button class="removeDirection" type="button">Remove</button></div>';
            $('#direction__container').append(directionField);
        });

        $(document).on('click', '.removeDirection', function() {
            $(this).parent().remove();
            directionCount--;
        });
    });
</script> -->



<section class="form__section">
    <div class="form__image-r">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div>
    <div class="container form__section-container">
        <h2>Add a Recipe</h2>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>


        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" placeholder="Recipe Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['title'] ?> </option>
                <?php endwhile ?>

            </select>

            <!-- cooking time + Serving -->
            <input type="number" name="serving" placeholder="Serving (eg. 8)">
            <input type="text" name="preptime" placeholder="Prep Time (eg. 30mins)">
            <input type="text" name="cookingtime" placeholder="Cooking Time (eg.45mins)">

            <!-- adding ingredients -->
            <div id="ingredient__container">
                <input type="text" name="ingredient" placeholder="Enter Ingredients (eg. 1 cup of flour)">
                <input type="submit" value="Add" class="btn">
            </div>
            <!-- <button id="add__ingredient" type="button" class="btn">Add Ingredient</button> -->

            <!-- adding directions -->
            <div id="direction__container">
                <input type="text" name="direction" placeholder="Enter direction. (eg.Step 1: Preheat the oven.">
                <input type="submit" value="Add" class="btn">
            </div>
            <!-- <button id="add__direction" type="button" class="btn">Add Direction</button> -->
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

            <button type="submit" name="submit" class="btn">+ Add Recipe</button>

        </form>

    </div>

</section>
<?php include "../partials/footer.php"; ?>