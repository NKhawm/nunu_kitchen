<?php
include "partials/header.php";
include "partials/search_bar.php";

//fetch post data from db if the id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipes WHERE id=$id";
    $result = mysqli_query($con, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'recipe.php');
    die();
}
?>
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>
<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $post['title'] ?></h2>
        <!-- author -->
        <div class="post__author">
            <?php
            //fetch author from users table 
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id= $author_id";
            $author_result = mysqli_query($con, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>

            <div class="post__author-avatar">
                <img src="./public-images/<?= $author['avatar'] ?>" alt="">
            </div>
            <div class="post__author-info">
                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>

        </div>

        <!-- Post thumbnail -->

        <div class="siglepost__thumbnail">
            <img src="./public-images/<?= $post['thumbnail'] ?>" alt="ramen">
        </div>

        <!-- post reaction -->
        <div class="post__reaction">
            <i class="uil uil-heart"></i>
            <i class="uil uil-favorite"></i>
            <i class="uil uil-share"></i>
        </div>
        <!-- short info -->
        <div class="info">
            <div>
                <p><strong>Prep Time:</strong></p>
                <p><?= $post['preptime'] ?></p>
            </div>
            <div>
                <p><strong>Cook Time:</strong></p>
                <p><?= $post['cookingtime'] ?></p>
            </div>
            <!-- <div>
                <p><strong>Total Time:</strong></p>
                <p>30mins</p>
            </div> -->
            <div>
                <p><strong>Servings:</strong></p>
                <p><?= $post['serving'] ?></p>
            </div>

        </div>

        <!-- Ingredients -->
        <div class="cooking__ingredients">
            <h2>Ingredients</h2>
            <ul>
                <li>Fish</li>
            </ul>


        </div>

        <!-- Cooking direction -->
        <div class="cooking__directions">
            <h2>Directions</h2>
            <ul>
                <li>Cook the fish</li>
            </ul>

        </div>

    </div>

</section>
<?php include "partials/footer.php" ?>