<?php
// Connect to your MySQL database
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["userName"];
    $comment = $_POST["userComment"];

    // Insert the comment into the guestbook
    $sql = "INSERT INTO guestbook (name, comment) VALUES ('$name', '$comment')";

    if ($conn->query($sql) === true) {
        echo "Comment added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();

    
    header("Location: index.html");
}
?>
