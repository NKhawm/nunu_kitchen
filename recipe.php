<?php
include 'partials/header.php';
include 'partials/search_bar.php';

//fetch featured post from database
$featured_query = "SELECT * FROM recipes WHERE is_featured=1";
$featured_result = mysqli_query($con, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

//fetch 9 post from recipes table
$query = "SELECT * FROM recipes ORDER BY date_time DESC";
$posts = mysqli_query($con, $query);

?>
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>
<!-- Show featured post if there's any post set for feature -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./public-images/<?= $featured['thumbnail'] ?>">
            </div>
            <div post__info>
                <?php
                //fetch category from categories table using category_id of post
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($con, $category_query);
                $category = mysqli_fetch_assoc($category_result);

                ?>
                <a href="<?= ROOT_URL ?>category-post.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 150) ?> ....
                </p>
                <div class="post__author">
                    <?php
                    //fetch author from users table 
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id= $author_id";
                    $author_result = mysqli_query($con, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post__author-avatar">
                        <img src="./public-images/<?= $author['avatar'] ?>" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?= "{$author['firstname']}{$author['lastname']}" ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </section>
<?php endif ?>

<!--================================================ End of Featured Post =================================== -->
<!--================================================ End of Featured Post =================================== -->

<section class="post <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./public-images/<?= $post['thumbnail'] ?> ">
                </div>
                <div class="post__info">

                    <?php
                    //fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($con, $category_query);
                    $category = mysqli_fetch_assoc($category_result);

                    ?>

                    <a href="<?= ROOT_URL ?>category-post.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
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


<?php
include 'partials/share_footer.php';
include 'partials/footer.php';
?>