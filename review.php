<section id="review">
    <?php

    if (isset($_POST['submit_review'])) {
        $name = $_POST['name'];
        $review = $_POST['comment'];
        $post_id = $post['id'];

        $review_sql = "INSERT INTO reviews (name, comment, post_id) VALUES ('$name', '$review', $post_id)";

        if ($con->query($review_sql) === TRUE) {
            echo "Review added successfully!";
        } else {
            echo "Error: " . $review_sql . "<br>" . $con->error;
        }
    }

    ?>
    <div class="container">
        <?php if (isset($_SESSION['add-review-post'])) : ?>
            <div class="alert__message success lg">
                <p><?= $_SESSION['add-review-post-success'];
                    unset($_SESSION['add-review-post-success']);
                    ?>
                </p>
            </div>
            <br>

        <?php endif ?>

        <h2 style="text-align: center;">Write your Reviews</h2>

        <div class="post__container">
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Enter Your Name..">
                <textarea name="comment" placeholder="Write your review for public"></textarea>
                <button type="submit" name="submit_review" class="btn">Post</button>
            </form>
        </div>
    </div>
    <br>
    <?php
    // Fetch the review count for the specific post using its ID
    $post_id = $post['id'];

    $count_sql = "SELECT COUNT(*) as review_count FROM reviews WHERE post_id = $post_id";
    $count_result = $con->query($count_sql);
    $review_count = 0; // Initialize the review count to 0

    if ($count_result->num_rows > 0) {
        $row = $count_result->fetch_assoc();
        $review_count = $row['review_count'];
    }
    ?>
    <h4 style="text-decoration:underline;" class="container"><?= $review_count ?> Reviews</h4>
    <div class="container display">
        <?php
        // Fetch comments for the specific post using its ID
        $display_sql = "SELECT * FROM reviews WHERE post_id = $post_id";

        $display_result = $con->query($display_sql);
        if ($display_result->num_rows > 0) {
            while ($row = $display_result->fetch_assoc()) {
        ?>

                <p><b><?= $row['name'] ?>: </b></p>
                <p><?= $row['comment'] ?></p>

        <?php
            }
        } else {
            // Display a message if no reviews found for the post
            echo '<p>No reviews found for this post.</p>';
        }
        ?>
    </div>
</section>