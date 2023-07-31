<?php
include "partials/header.php";
if (!isset($_SESSION['user-id'])) {
?> <div class="alert__message error lg" style="padding-top:100px;">
        <p>Please login to continue </p>
    </div>
<?php
    exit();
}


if (isset($_SESSION['user-id'])) {


    if (isset($_GET['recipe_id'])) {
        $recipe_id = filter_var($_GET['recipe_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = $_SESSION['user-id'];

        $query = "SELECT * FROM favourites WHERE user_id = $user_id AND recipe_id = $recipe_id";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $delete_query = "DELETE FROM favourites WHERE user_id = $user_id AND recipe_id = $recipe_id";
            mysqli_query($con, $delete_query);
        } else {
            $insert_query = "INSERT INTO favourites (user_id, recipe_id) VALUES ($user_id, $recipe_id)";
            mysqli_query($con, $insert_query);
        }
    }
}

// Fetch the favorite recipes for the logged-in user
$user_id = $_SESSION['user-id'];
$query = "SELECT recipes.* FROM recipes
              JOIN favourites ON recipes.id = favourites.recipe_id
              WHERE favourites.user_id = $user_id
              ORDER BY date_time DESC";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query was executed successfully
if (!$result) {
    // Query failed, handle the error or show an appropriate message
    die("Error executing the query: " . mysqli_error($con));
}


$favorite_recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<style type="text/css">
    body {
        background-color: #4C5959;
        margin-top: 20px;
    }
</style>

<?php if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id'];

    // Fetch the user's information from the database
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($con, $query);
    $user_info = mysqli_fetch_assoc($result);
}
?>

<h1 style="padding-top:80px; text-align:center;"><?= $user_info['firstname'] ?>'s Favorite Recipes</h1>

<?php if (isset($favorite_recipes) && count($favorite_recipes) > 0) : ?>
    <section class="post">
        <div class="container posts__container">
            <?php foreach ($favorite_recipes as $recipe) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="./public-images/<?= $recipe['thumbnail'] ?>">
                    </div>
                    <div class="post__info">
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $recipe['id'] ?>"><?= $recipe['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($recipe['body'], 0, 150) ?> ....
                        </p>
                        <div class="post__author">
                            <?php
                            //fetch author from users table 
                            $author_id = $recipe['author_id'];
                            $author_query = "SELECT * FROM users WHERE id = $author_id";
                            $author_result = mysqli_query($con, $author_query);
                            $author = mysqli_fetch_assoc($author_result);
                            ?>
                            <div class="post__author-avatar">
                                <img src="./public-images/<?= $author['avatar'] ?>" alt="">
                            </div>
                            <div class="post__author-info">
                                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                                <small>
                                    <?= date("M d, Y - H:i", strtotime($recipe['date_time'])) ?>
                                </small>
                            </div>
                        </div>
                        <div class="post__favorite">
                            <?php
                            // Check if the recipe is already a favorite for the logged-in user
                            $is_favorite = true; // Set to true by default (for display purposes)

                            $recipe_id = $recipe['id'];
                            $check_favorite_query = "SELECT * FROM favourites WHERE recipe_id = $recipe_id AND user_id = $user_id";
                            $check_favorite_result = mysqli_query($con, $check_favorite_query);
                            $is_favorite = mysqli_num_rows($check_favorite_result) > 0;

                            if ($is_favorite) {
                                // The recipe is already a favorite, display a link to remove it
                                echo '<a href="?recipe_id=' . $recipe_id . '&action=remove">Remove from Favorites</a>';
                            } else {
                                // The recipe is not a favorite, display a link to add it
                                echo '<a href="?recipe_id=' . $recipe_id . '&action=add">Add to Favorites</a>';
                            }
                            ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error lg">
        <p>No favorite recipes found</p>
    </div>
<?php endif ?>

<?php
include "partials/footer.php";
?>