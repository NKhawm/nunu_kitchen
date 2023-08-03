<!-- <section class="share__recipe">
    <div class="container container__share">
        <p>Got your own recipes? Why not share with the world. </p>
        <h2> Create Your Recipe</h2>
        <a class="share" href="recipe.php">+ Create</a>
    </div>

</section> -->
<footer>
    <div class="footer__social">
        <a href="https://www.facebook.com/profile.php?id=100032304594886" target="blank"><i class="uil uil-facebook"></i></a>
        <a href="https://instagram.com/nunukitchen2020?igshid=NTc4MTIwNjQ2YQ==" target="blank"><i class="uil uil-instagram"></i></a>
        <a href="" target="blank"><i class="uil uil-linkedin"></i></a>
        <a href="https://www.youtube.com/channel/UCjgrVfmv48hdVW4QL6Qnd3w" target="blank"><i class="uil uil-youtube"></i></a>
    </div>

    <div class="container footer__container">
        <article>
            <h4>Pages </h4>
            <ul>
                <li><a href="<?= ROOT_URL ?>admin/index.php">Your Dashboard</a></li>
                <li><a href="<?= ROOT_URL ?>.about__title">About Us</a></li>
                <li><a href="<?= ROOT_URL ?>recipe.php">Recipes</a></li>
                <li><a href="<?= ROOT_URL ?>howto.php">How to Upload Your Recipes</a></li>
                <li><a href="<?= ROOT_URL ?>contact_us.php">Contact Us</a></li>

            </ul>

        </article>
        <!-- float image -->
        <img class="shape-7" src="<?= ROOT_URL ?>images/shape-7.png" alt="shape-7">
        <article>
            <h4>Useful Links</h4>
            <ul>
                <li><a href="">Terms and Condition</a></li>
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Site Credit</a></li>
            </ul>

        </article>
        <!--  -->
        <article>
            <?php
            if (isset($_POST['submit_list'])) {
                $mail = filter_input(INPUT_POST, 'mailing_list', FILTER_VALIDATE_EMAIL);

                if ($mail === false) {
                    echo "Error: Invalid email address";
                } else {
                    $query = "INSERT INTO mail_list (email_address) VALUES ('$mail')";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        echo "Thank you for subscribing to our mailing list!";
                    } else {
                        echo "Error: Unable to add email to the mailing list";
                    }
                }
            }
            ?>

            <h4>Join Our Mailing List</h4>
            <div class="footer__email">
                <form action="" method="POST">
                    <input class="input__email" type="text" name="mailing_list" placeholder="enter your email here">

                    <button type="submit" name="submit_list" class="btn">Join</button>
                </form>
            </div>
            <p>Join our newsletter to stay up to date on features and releases</p>

        </article>

    </div>
    <div class="footer__copyright">
        <small>Design and created by Niang Khawm Huai</small>
    </div>

</footer>

</body>
<script src="<?= ROOT_URL ?>js/main.js"></script>



</html>