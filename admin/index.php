<?php

include "partials/header.php";


if (isset($_SESSION['user-id'])) {
    $user_id = $_SESSION['user-id'];
    $user_is_admin = isset($_SESSION['user_is_admin']);

    // Fetch the user's information from the database
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($con, $query);
    $user_info = mysqli_fetch_assoc($result);

    // Fetch posts based on user role
    if ($user_is_admin) {
        // Fetch all posts for admin
        $query = "SELECT r.id, r.title, r.category_id, c.title AS category_title
                  FROM recipes AS r
                  JOIN categories AS c ON r.category_id = c.id
                  ORDER BY r.id DESC";
    } else {
        // Fetch only user's posts for non-admin users
        $query = "SELECT r.id, r.title, r.category_id, c.title AS category_title
                  FROM recipes AS r
                  JOIN categories AS c ON r.category_id = c.id
                  WHERE r.author_id = $user_id
                  ORDER BY r.id DESC";
    }

    $posts = mysqli_query($con, $query);
} else {
    // User is not logged in, redirect to login or homepage
    header('location: ' . ROOT_URL . 'recipe.php');
    die();
}

?>

<style type="text/css">
    body {
        background-color: #4C5959;
    }
</style>

<section class="dashboard">
    <h2 style="text-align: center;">Welcome "<?= $user_info['firstname'] ?></h2>
    <?php if (isset($_SESSION['add-post-success'])) : // shows if add post was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : // shows if edit post was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])) : // shows if edit post was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-post-success'])) : // shows if delete post was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>

            <ul>
                <li>
                    <a href="addpost.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>

                <li>
                    <a href="index.php" class="active"><i class="uil uil-postcard"></i>
                        <h5>Manage Post</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>

                    <li>
                        <a href="add-user.php"><i class="uil uil-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>

                    <li>
                        <a href="manage-user.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>

                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>

                    <li>
                        <a href="manage-category.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Category</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <!-- end of aside -->

            <h2>Manage Posts</h2>
            <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['category_title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm edit">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>

                            </tr>
                        <?php endwhile ?>


                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No posts found." ?></div>
            <?php endif ?>
        </main>


    </div>


</section>
<?php include "../partials/footer.php"; ?>