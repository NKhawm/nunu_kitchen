<?php include "partials/header.php";
// get back form if there's an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
//$userrole = $_SESSION['add-user-data']['userrole'] ?? null;

//delete session data
unset($_SESSION['add-user-data']);
?>


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
        <?php if (isset($_SESSION['add-user'])) : ?>
            <div class="alert__message-error">
                <p><?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
            <br>

        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">

            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">

            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">

            <input type="text" name="email" value="<?= $email ?>" placeholder="Email">

            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">

            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>


            <button type="submit" name="submit" class="btn">Add User</button>

        </form>


    </div>

</section>
<?php include "../partials/footer.php"; ?>