<?php include "partials/header.php"; ?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign In</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div>
        <form action="">
            <input type="text" placeholder="Email">
            <input type="password" placeholder="Password">
            <br><br>
            <button type="submit" class="sign__btn">Sign In</button>
            <small>Don't have an account with us? <a href="signin.php">Sign Up </a>here.</small>

        </form>

    </div>
    <div class="form__image">

        <img src="https://source.unsplash.com/1600x900/?food" alt="">
    </div>
</section>
<?php include "partials/footer.php"; ?>