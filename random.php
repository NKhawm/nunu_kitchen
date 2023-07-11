<?php include 'partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tester</title>
</head>
<style>
    body {

        background: darkolivegreen;
    }

    .form {
        width: 60%;
        text-align: center;
        margin: auto;
    }
</style>

<body>
    <h1>Testing 123</h1>
    <form action="">
        <div class="form" method="POST">
            <label for="Ingredients">Add Ingredients</label>
            <textarea name="ingredients" id="" cols="30" rows="10"></textarea>
            <button>send</button>
        </div>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <div><?= $_POST['ingredients'] ?></div>
    <?php endif ?>
</body>