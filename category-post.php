<?php
include "partials/header.php";
//include "partials/search_bar.php";

//fetch posts if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM recipes WHERE  category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($con, $query);
} else {
    header('location: ' . ROOT_URL . 'recipe.php');
    die();
}

?>
<style type="text/css">
    body {
        background-color: #4C5959;
        margin-top: 20px;
    }
</style>

<header class="category__title">
    <h2>
        <?php
        //fetch category from categories table using category_id of post
        $category_id = $id;
        $category_query = "SELECT * FROM categories WHERE id=$id";
        $category_result = mysqli_query($con, $category_query);
        $category = mysqli_fetch_assoc($category_result);
        echo $category['title'];
        ?>
    </h2>
</header>
<!-- =======end of category title ======== -->

<?php if (mysqli_num_rows($posts) > 0) : ?>
    <section class="post">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="./public-images/<?= $post['thumbnail'] ?> ">
                    </div>
                    <div class="post__info">
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($post['body'], 0, 150) ?> ....

                        </p>
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
                    </div>

                </article>
            <?php endwhile ?>
        </div>
    </section>
<?php else : ?>

    <div class="alert__message error lg">
        <p>No recipes found for this category</p>
    </div>
<?php endif ?>



<!-- category  -->
<section class="category__buttons">
    <div class="container category__button-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($con, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>

    </div>
</section>

<?php include "partials/share_footer.php"; ?>
<?php include "partials/footer.php"; ?>