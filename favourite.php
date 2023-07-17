<?php
require_once('partials/db.php');

if (isset($_GET['userid']) && isset($_GET['recipeid'])) {
    $userid = filter_var($_GET['userid'], FILTER_SANITIZE_NUMBER_INT);
    $recipeid = filter_var($_GET['recipeid'], FILTER_SANITIZE_NUMBER_INT);

    try {
        $select = $con->prepare("SELECT COUNT(*) AS count FROM favourites WHERE userid = ? AND recipeid = ?");
        $select->execute([$userid, $recipeid]);
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['count'] > 0) {
            $delete = $con->prepare("DELETE FROM favourites WHERE userid = ? AND recipeid = ?");
            $delete->execute([$userid, $recipeid]);
            echo "Favorite removed successfully!";
        } else {
            $insert = $con->prepare("INSERT INTO favourites (userid, recipeid) VALUES (?, ?)");
            $insert->execute([$userid, $recipeid]);
            echo "Favorite added successfully!";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "User ID and Recipe ID not provided!";
}
