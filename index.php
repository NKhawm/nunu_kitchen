<?php
include 'partials/header.php';
include 'partials/search_bar.php';

?>

<!-- Hero  -->
<section class="hero">

    <div class="container container__hero">

        <div class="hero__title">
            <h1>Satisfy your cravings</h1>
            <h2>Learn, Share and Create with us.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Quas dolore obcaecati repudiandae sint natus, distinctio repellat? Aut commodi, voluptatum maxime eaque facilis mollitia expedita officia omnis quidem quae, adipisci nulla.</p>
            <br>

            <a class="browse__recipe" href="<?= ROOT_URL ?>recipe.php">Browse Recipes</a>

        </div>
        <div class="hero__image">
            <img src="images/noodles.png" alt="hero-image">

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


<!-- Marquee -->
<section class="marquee__section">

    <div class="marquee">
        <div class="marquee-content">

            <div class="marquee-item">
                <img src="images/sebastian-coman-photography--hM0-PSO3FY-unsplash.jpg" width="" height="" alt="">
                <p>Ice Cream</p>
            </div>

            <div class="marquee-item">
                <img src="images/tatiana-lapina-qpf2glK0bAA-unsplash.jpg" width="" height="" alt="">
                <p>Macarons</p>
            </div>

            <div class="marquee-item">
                <img src="images/strawberry.jpg" width="" height="" alt="">
                <p>Strawberry </p>
            </div>

            <div class="marquee-item">
                <img src="images/brenda-godinez-MsTOg6rhRVk-unsplash.jpg" width="" height="" alt="">
                <p>Kiwi Yogurt</p>
            </div>

            <div class="marquee-item">
                <img src="images/jason-leung-X_-utfkjE7Y-unsplash.jpg" width="" height="" alt="ramen">
                <p>Ramen</p>
            </div>

            <div class="marquee-item">
                <img src="images/lindsay-moe-sKM8RK2C-YI-unsplash.jpg" alt="">
                <p>Ice Pop</p>
            </div>
            <div class="marquee-item">
                <img src="images/beefstew.png" alt="">
                <p>Beef Stew</p>
            </div>
            <div class="marquee-item">
                <img src="images/focused-on-you-grDcbeK2MRY-unsplash.jpg" alt="">
                <p>Egg Fried Noodle</p>
            </div>
            <div class="marquee-item">
                <img src="images/dessert.jpg" alt="">
                <p>Pavlova</p>
            </div>
            <div class="marquee-item">
                <img src="images/bananatree.jpg" alt="">
                <p>Banana Smoothie</p>
            </div>
            <div class="marquee-item">
                <img src="images/dumpling.png" alt="">
                <p>Dumplings</p>
            </div>
            <div class="marquee-item">
                <img src="images/obi-pixel7propix-kdB88FBL8bs-unsplash.jpg" alt="">
                <p>Fried Rice</p>
            </div>
            <div class="marquee-item">
                <img src="images/max-griss-YpfRCe5lda0-unsplash.jpg" alt="">
                <p>Chicken Coconut Noodles</p>
            </div>
        </div>
    </div>
</section>

<?php include 'partials/share_footer.php'; ?>
<?php include 'partials/footer.php'; ?>