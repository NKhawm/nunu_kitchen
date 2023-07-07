<?php
include 'partials/header.php';
// Retrieve the form data
$name = $_POST['name'];
$list = $_POST['list'];

// Perform validation and sanitization on the form data if required

// Connect to the database
// ...

// Prepare the SQL statement
$sql = "INSERT INTO ingredients (name, list) VALUES ('$name', '$list')";

// Execute the SQL statement
if (mysqli_query($con, $sql)) {
    // Insertion successful
    echo "Ingredient added successfully.";
} else {
    // Insertion failed
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>



<form action="add_ingredient.php" method="POST">
    <label for="name">Ingredient Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="list">Ingredient List:</label>
    <textarea id="list" name="list" rows="4" required></textarea>

    <input type="submit" value="Add Ingredient">
</form>

<!-- <div id="ingredients-wrap">
  <?php foreach ($ingredients as $index => $ingredient) : ?>
                    <div class="my_box">
                        <div class="field_box">
                            <input type="text" name="ingredient[]" value="<?= $ingredient ?>" placeholder="Add ingredients. (eg. 1 cup of flour.)">
                        </div>
                        <div class="button_box">
                            <!-- <button type="button" name="add" id="add" class="sign__btn" onclick="add_more()"><i class="uil uil-plus-square"></i></button> -->
<button type="button" class="sign__btn" onclick="removeMore('ingredients-wrap', <?= $index ?>)"><i class="uil uil-trash-alt"></i></button>
</div>
</div>
<?php endforeach ?>

</div>
<button type="button" class="sign__btn" onclick="addMore('ingredients-wrap') "><i class="uil uil-plus-square"></i></button>




<!-- text area -->
<?php echo isset($ingredients) ? $ingredients : '' ?>