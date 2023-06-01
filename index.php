<?php
include 'partials/header.php';
?>
<?php include 'partials/search_bar.php'; ?>

<!-- Hero  -->
<section class="hero">
    <div class="container container__hero">
        <div class="hero__title">
            <h1>Satisfy your cravings</h1>
            <h2>Learn, Share and Create with us.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                Quas dolore obcaecati repudiandae sint natus, distinctio repellat? <br>Aut commodi, voluptatum maxime eaque facilis mollitia expedita <br>officia omnis quidem quae, adipisci nulla.</p>
            <br>
            <a class="browse__recipe" href="<?= ROOT_URL ?>recipe.php">Browse Recipes</a>

        </div>
        <div class="hero__image">
            <img src="images/noodles.png" alt="hero-image">

        </div>

    </div>
</section>

<!-- Marquee -->
<section class="marquee__section">

    <div class="marquee">
        <div class="marquee-content">

            <div class="marquee-item">
                <img src="images/biryani.png" width="" height="" alt="">
                <p>Chicken Biryani</p>
            </div>

            <div class="marquee-item">
                <img src="images/beefstew.png" width="" height="" alt="">
                <p>Beef Stew</p>
            </div>

            <div class="marquee-item">
                <img src="images/dumpling.png" width="" height="" alt="">
                <p>Dumpling</p>
            </div>

            <div class="marquee-item">
                <img src="images/friedrice.png" width="" height="" alt="">
                <p>Fried Rice</p>
            </div>

            <div class="marquee-item">
                <img src="images/ramen.png" width="" height="" alt="ramen">
                <p>Ramen</p>
            </div>

            <div class="marquee-item">
                <img src="images/icepop.png" alt="">
                <p>Ice Pop</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about">
    <div class="container container__about">

        <img class="nature-15" src="images/nature-15.png" alt="muchroom">

        <div class="about__image">
            <img src="images/dessert.jpg" alt="about-image">

        </div>

        <div class="about__title">
            <h1>NuNu’s Kitchen</h1>
            <p>We believe that cooking is not only about cooking, it’s also about learning, sharing
                and creating memories with others. We provide a platform for home cooks of all
                skill levels to come together, explore new recipes, and share their culinary creations
                with a like-minded community. Join our community of home cooks and discover
                the endless possibilities of culinary creativity. </p>
            <br>
            <a class="join__button" href="<?= ROOT_URL ?>signup.php">Join Now</a>

        </div>


    </div>
</section>

<?php include 'partials/share_footer.php'; ?>
<?php include 'partials/footer.php'; ?>