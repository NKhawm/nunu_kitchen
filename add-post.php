<?php include "partials/header.php"; ?>

<!-- Page background -->
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>

<!-- J query for adding individual ingredient -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var ingredientCount = 1;

        $('#add__ingredient').click(function() {
            ingredientCount++;
            var ingredientField = '<div class="ingredient"><input type="text" name="ingredient[]" placeholder="Ingredient ' + ingredientCount + '"><button class="removeIngredient" type="button">Remove</button></div>';
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
            var directionField = '<div class="direction"><input type="text" name="step[]" placeholder="Step ' + directionCount + '"><button class="removeDirection" type="button">Remove</button></div>';
            $('#direction__container').append(directionField);
        });

        $(document).on('click', '.removeDirection', function() {
            $(this).parent().remove();
            directionCount--;
        });
    });
</script>



<section class="form__section">
    <div class="form__image-r">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div>
    <div class="container form__section-container">
        <h2>Add a Recipe</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div>
        <form action="" enctype="multipart/form-data" method="POST">
            <input type="text" placeholder="Recipe Title">
            <select>
                <option value="1">Asian</option>
                <option value="1">Burmese</option>
                <option value="1">Desert</option>
                <option value="1">Drink</option>
                <option value="1">Asian</option>
                <option value="1">Asian</option>
                <option value="1">Asian</option>
            </select>
            <!-- adding ingredients -->
            <div id="ingredient__container">
                <div class="ingredient">
                    <input type="text" name="ingredient[]" placeholder="Ingredient 1 (eg. 1 cup - Flour)">
                </div>
            </div>
            <button id="add__ingredient" type="button" class="btn">Add Ingredient</button>
            <!-- adding directions -->
            <div id="direction__container">
                <div class="direction">
                    <input type="text" name="step[]" placeholder="Step 1 (eg. Preheat the oven)">
                </div>
            </div>
            <button id="add__direction" type="button" class="btn">Add Direction</button>



            <div class="form__control inline">
                <input type="checkbox" id="is_featured">
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>

            <button type="submit" class="btn">Add Post</button>

        </form>

    </div>

</section>
<?php include "partials/footer.php"; ?>