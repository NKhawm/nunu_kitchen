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

        <h2>Add User</h2>
        <div class="alert__message-error">
            <p>This is an error message</p>
        </div><br>
        <form action="" enctype="multipart/form-data">
            <form action="" enctype="multipart/form-data">

                <input type="text" placeholder="First Name">

                <input type="text" placeholder="Last Name">

                <input type="text" placeholder="Email">

                <input type="password" placeholder="Password">

                <input type="password" placeholder="Confirm Password">
                <select>
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>

                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" id="avatar">
                </div>


                <button type="submit" class="btn">Add User</button>

            </form>


    </div>

</section>
<?php include "partials/footer.php"; ?>