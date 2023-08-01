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
    <?php if (isset($_SESSION['add-review-post-success'])) : // shows if review post was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-review-post-success'];
                unset($_SESSION['add-review-post-success']);
                ?>
            </p>

        </div>
    <?php endif ?>
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
            <div>
                <span>Print<i class="uil uil-print" onclick="window.print()" id="print_btn"></i></span>
            </div>
            <!-- Add the heart icon (favorite button) -->

            <!-- Display the heart icon for "Add to Favorite" -->
            <div class="favorite-icon <?= $is_favorite ? 'favorited' : '' ?>">
                Add to Favourite<a href="favourites.php?recipe_id=<?= $post['id'] ?>">
                    <i class="uil uil-heart"></i>
                </a>
            </div>

            <!-- WRITE A REVIEW -->

            <div>
                <span>Write a review <a href="#review"><i class="uil uil-comment-alt-message" id="myBtn"></i></a></span>
                <div id="myModal" class="modal">


                </div>

            </div>
            <!-- Social media sharing -->
            <div>
                <span>Share <i class="uil uil-share-alt" id="my-btn"></i></span>
                <div id="my-modal" class="modal">
                    <div class="modal-content">
                        <span class="close1">&times;</span>
                        <p>share</p>
                        <div class="social">

                            <?php

                            // Get the current page URL
                            $currentPageUrl = urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

                            // Define the social media platforms and their respective URLs
                            $socialMedia = [
                                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $currentPageUrl,
                                'twitter' => 'https://twitter.com/share?url=' . $currentPageUrl,
                                'linkedin' => 'https://www.linkedin.com/shareArticle?url=' . $currentPageUrl,
                                //'reddit' => 'https://www.reddit.com/submit?url=' . $currentPageUrl,
                                'whatsapp' => 'whatsapp://send?text=' . $currentPageUrl,
                                'discord' => 'https://discord.com/login?redirect_to=' . $currentPageUrl,
                                'telegram' => 'https://t.me/share/url?url=' . $currentPageUrl
                            ];

                            // Generate the social media sharing links
                            foreach ($socialMedia as $platform => $url) {
                                echo '<a class="' . $platform . '" target="_blank" href="' . $url . '"><i class="uil uil-' . $platform . '"></i></a>';
                            }
                            ?>



                        </div>
                    </div>

                </div>
            </div>

        </div>



        <!-- short info -->
        <div class=" info">
            <div>
                <p><strong>Prep Time:</strong></p>
                <p><?= $post['preptime'] ?></p>
            </div>
            <div>
                <p><strong>Cook Time:</strong></p>
                <p><?= $post['cookingtime'] ?></p>
            </div>
            <div>
                <p><strong>Total Time:</strong></p>
                <p><?= intval($post['preptime']) + intval($post['cookingtime']) . " minutes"; ?></p>

            </div>
            <div>
                <p><strong>Servings:</strong></p>
                <p><?= $post['serving'] ?></p>
            </div>

        </div>

        <!-- Ingredients -->
        <div class="cooking__ingredients">
            <h2>Ingredients</h2>
            <p><?= htmlspecialchars_decode($post['ingredient']) ?></p>

        </div>


        <div class="cooking__directions">
            <h2>Directions</h2>
            <p><?= htmlspecialchars_decode($post['direction']) ?></p>
        </div>

    </div>

</section>
<hr>

<!-- Review  -->
<?php include "review.php" ?>
<!-- script for modal -->
<script>
    /* modal for social media sharing */

    var moDal = document.getElementById("my-modal");

    // Get the button that opens the modal
    var btN = document.getElementById("my-btn");

    // Get the <span> element that closes the modal
    var spann = document.getElementsByClassName("close1")[0];

    // When the user clicks the button, open the modal 
    btN.onclick = function() {
        moDal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    spann.onclick = function() {
        moDal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == moDal) {
            modal.style.display = "none";
        }
    }
</script>



<?php include "partials/footer.php" ?>