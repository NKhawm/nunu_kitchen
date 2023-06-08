<?php include "partials/header.php"; ?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <div class="alert__message-success">
            <p>This is an error message</p>
        </div>
        <form action="">
            <input type="text" placeholder="First Name">

            <input type="text" placeholder="Last Name">

            <input type="text" placeholder="Email">

            <input type="password" placeholder="Password">

            <input type="password" placeholder="Confirm Password">

            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar">
            </div><br>
            <button type="submit" class="sign__btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In </a>here.</small>

        </form>

    </div>
    <div class="form__image">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unsplash images">
    </div>
</section>
<?php include "partials/footer.php"; ?>