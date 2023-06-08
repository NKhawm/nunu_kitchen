<?php include "partials/header.php" ?>
<?php include "partials/search_bar.php" ?>
<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>
<section class="singlepost">
    <div class="container singlepost__container">
        <h2>Seafood Ramen</h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="./images/profilepic.png" alt="">
            </div>
            <div class="post__author-info">
                <h5>By: Niang</h5>
                <small>June 10,2023</small>
            </div>

        </div>
        <div class="siglepost__thumbnail">
            <img src="./images/ramen.jpeg" alt="ramen">
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
                <p>15mins</p>
            </div>
            <div>
                <p><strong>Cook Time:</strong></p>
                <p>15mins</p>
            </div>
            <div>
                <p><strong>Total Time:</strong></p>
                <p>30mins</p>
            </div>
            <div>
                <p><strong>Servings:</strong></p>
                <p>8</p>
            </div>

        </div>

        <!-- Ingredients -->
        <div class="cooking__ingredients">
            <h2>Ingredients</h2>
            <ul>
                <li>2 packs noodle</li>
                <li>1 onion</li>
                <li>3 garlic clove</li>
                <li>1 small ginger</li>
                <li>1 carrot</li>
                <li>2 table spoons oil</li>
                <li>salt to taste</li>
            </ul>

        </div>

        <!-- Cooking direction -->
        <div class="list-container">
            <ul class="list">
                <li class="list-item list-title">Direction</li>
                <li class="list-item checked">
                    <div class="list-item-check">
                        <i class="icon ion-checkmark-round"></i>
                    </div>
                    <div class="list-item-title">
                        <span class="list-item-title-strikethrough"></span>
                        Update page
                    </div>
                </li>
                <li class="list-item">
                    <div class="list-item-check">
                        <i class="icon ion-checkmark-round"></i>
                    </div>
                    <div class="list-item-title">
                        <span class="list-item-title-strikethrough"></span>
                        Add image to dropdown
                    </div>
                </li>
                <li class="list-item">
                    <div class="list-item-check">
                        <i class="icon ion-checkmark-round"></i>
                    </div>
                    <div class="list-item-title">
                        <span class="list-item-title-strikethrough"></span>
                        Update order on Events page
                    </div>
                </li>
                <li class="list-item">
                    <div class="list-item-check">
                        <i class="icon ion-checkmark-round"></i>
                    </div>
                    <div class="list-item-title">
                        <span class="list-item-title-strikethrough"></span>
                        Send for review
                    </div>
                </li>
                <li class="list-item is-last">
                    <div class="list-item-check">
                        <i class="icon ion-checkmark-round"></i>
                    </div>
                    <div class="list-item-title">
                        <span class="list-item-title-strikethrough"></span>
                        Clear Update Request item
                    </div>
                </li>
            </ul>
        </div>

    </div>

</section>
<?php include "partials/footer.php" ?>