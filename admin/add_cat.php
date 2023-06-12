<?php include "partials/header.php"; ?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div>
        <form action="">
            <input type="text" placeholder="Title">
            <textarea name="" id="" cols="30" rows="4" placeholder="Description"></textarea>
            <br><br>
            <button type="submit" class="sign__btn">Add Category</button>

        </form>

    </div>

</section>
<?php include "../partials/footer.php"; ?>