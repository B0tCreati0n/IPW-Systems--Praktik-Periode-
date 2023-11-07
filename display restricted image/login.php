<?php
session_start();

$users = array(
    "Noah" => "MyPassword",
    "Ulrik" => "12345678",
    "Martin" => "Sup3rP4ssw0rd!"
);

if (isset($_POST['B0tUsername']) && isset($_POST['B0tPassword'])) {
    $username = $_POST['B0tUsername'];
    $password = $_POST['B0tPassword'];

    if (array_key_exists($username, $users) && $users[$username] === $password) {
        echo "Login successful!\n";
        $_SESSION["SessionUser"] = $_POST["B0tUsername"];
        echo "Welcome ". $_SESSION["SessionUser"];
        header("Location: ./show%20image/index.php");
    } else {
        echo "Login failed. Please check your username and password.";

    }
}
?>
