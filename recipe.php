<?php
include 'partials/header.php';
include 'partials/search_bar.php';

//fetch featured post from database
$featured_query = "SELECT * FROM recipes WHERE is_featured=1";
$featured_result = mysqli_query($con, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

//fetch 9 post from recipes table
$query = "SELECT * FROM recipes ORDER BY date_time DESC LIMIT 9";
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
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 300) ?>....
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

<section class="post">
    <div class="container posts__container">
        <article class="post">
            <div class="post__thumbnail">
                <img src="images/biryani.png ">
            </div>
            <div class="post__info">
                <a href="cat__post.php" class="category__button">Asian</a>
                <h3 class="post__title"><a href="post.php">Fried Rice
                    </a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Consequuntur nulla corporis perferendis
                    quod quo tenetur officiis? Esse nihil molestias voluptate
                    repellat, sint dolorem, earum possimus obcaecati aperiam
                    dolore consequatur
                    blanditiis.

                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/profilepic.png" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: Niang</h5>
                        <small>June 10,2023</small>
                    </div>

                </div>
            </div>

        </article>


    </div>
</section>

<!-- category  -->
<section class="category__buttons">
    <div class="container category__button-container">
        <a href="" class="category__button">Burmese</a>
        <a href="" class="category__button">Asian</a>
        <a href="" class="category__button">Western</a>
        <a href="" class="category__button">Deserts</a>
        <a href="" class="category__button">Cakes</a>
        <a href="" class="category__button">Drinks</a>

    </div>
</section>


<?php
include 'partials/share_footer.php';
include 'partials/footer.php';
?>