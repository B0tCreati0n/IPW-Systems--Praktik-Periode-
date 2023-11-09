<?php
// Moved the function definition to the top for better organization
function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

session_start();

// Session token to keep
$sessionToKeep = 'B0tUserIdToken';

if (!isset($_SESSION[$sessionToKeep])) {
    $_SESSION[$sessionToKeep] = generateRandomString();
}

// Set the lifespan for the specified session token
$_SESSION[$sessionToKeep.'_expires'] = time() + 157680000;

// Loop through all session variables
foreach ($_SESSION as $key => $value) {
    // Check if the variable name is not the one you want to keep
    if ($key !== $sessionToKeep.'_expires') {
        // Set the default lifespan to 900 seconds for other session variables
        $_SESSION[$key.'_expires'] = time() + 900;
        
        // Unset the session variable if it exceeds the default lifespan
        if ($_SESSION[$key.'_expires'] < time()) {
            unset($_SESSION[$key]);
        }   
    }
}

// Destroy the session if the specified token exceeds its lifespan
if ($_SESSION[$sessionToKeep.'_expires'] < time()) {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>