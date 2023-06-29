<!DOCTYPE html>
<html>

<head>
    <title>Add Items to List and Database Dynamically</title>
</head>

<body>
    <h1>Add Items to List and Database Dynamically</h1>

    <form method="POST">
        <input type="text" name="item" placeholder="Enter an item">
        <input type="submit" value="Add">
    </form>

    <h2>Item List:</h2>
    <ul>
        <?php
        session_start();

        // Check if the list exists in the session
        if (!isset($_SESSION['items'])) {
            $_SESSION['items'] = array();
        }

        // Check if a new item is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = $_POST['item'];
            if (!empty($item)) {
                // Add the item to the list
                array_push($_SESSION['items'], $item);

                // Add the item to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "nunu_kitchen";

                // Create a connection to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check if the connection is successful
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert the item into the database
                $sql = "INSERT INTO items (name) VALUES ('$item')";

                if ($conn->query($sql) === TRUE) {
                    echo "<li>$item</li>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
            }
        }

        // Display the items in the list
        foreach ($_SESSION['items'] as $item) {
            echo "<li>$item</li>";
        }
        ?>
    </ul>
</body>

</html>