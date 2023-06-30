<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch category from db
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage-category.php');
    die();
}
?>
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title">
            <input name="description" value="<?= $category['description'] ?>" placeholder="Description">
            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
    <div class="form__image">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div>
</section>

<?php include '../partials/footer.php'; ?>