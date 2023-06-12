<?php include "partials/header.php"; ?>


<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Title">
            <select>
                <option value="1">Asian</option>
                <option value="1">Burmese</option>
                <option value="1">Desert</option>
                <option value="1">Drink</option>
                <option value="1">Asian</option>
                <option value="1">Asian</option>
                <option value="1">Asian</option>
            </select>


            <textarea rows="4" placeholder="Body"></textarea>
            <div class="form__control inline">
                <input type="checkbox" id="is_featured">
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>

            <button type="submit" class="sign__btn">Add Category</button>

        </form>

    </div>

</section>
<?php include "partials/footer.php"; ?>