<?php include "partials/header.php"; ?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>



<section class="form__section">
    <div class="form__image-r">

        <img src="https://source.unsplash.com/1600x900/?food" alt="unplash images">
    </div>
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div><br>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Title">
            <textarea rows="4" placeholder="Description"></textarea>

            <button type="submit" class="btn">Add Category</button>

        </form>

    </div>

</section>
<?php include "../partials/footer.php"; ?>