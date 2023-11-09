<?php 
    session_start();
    // Session token to keep
    $sessionToKeep = 'B0tUserIdToken';

    // Set the lifespan for the specified session token
    $_SESSION[$sessionToKeep.'_expires'] = time() + 31536000;

    if (!isset($_SESSION["B0tAnswareCounter"])) {
        $_SESSION["B0tAnswareCounter"] = 2;
    };
    // Destroy the session if the specified token exceeds its lifespan
    if ($_SESSION[$sessionToKeep.'_expires'] < time()) {
    session_destroy();
    };
    require "./addNewPollToDB.php";

    if (isset($_POST['B0tNewPollSubmitBtn'])) {
        // Call the PHP function
        B0tSaveFormData();
        // Session token to keep
        $sessionToKeep = 'B0tUserIdToken';
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


        // Destroy the session
        session_destroy();
        Header("Location: ./success.html");
        exit();
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Poll</title>

</head>
<body>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #4e91cc; /* Light Blue background */
        }

        .container {
            width: 600px;
            margin: 25px 0;
            background-color: white;
            padding: 20px;
            border-radius: 15px; /* Rounded edges */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a modern look */
        }

        .title {
            text-align: center;
        }

        .forms {
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50; /* Green Submit button */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <div class="container">
        <div class="title">
            <h1>New Poll Creator</h1>
        </div>
        <div class="forms">
            <form method="POST">
                <label>Please enter your email</label>
                <input type="email" placeholder="example@example.com" name="userEmail" id="userEmail" maxlength="255">
                <label>Poll Name</label>
                <input type="text" placeholder="Poll Name" name="B0tPollName" id="B0tNewPollName" minlength="5" maxlength="64">
                <label>Answers</label>
                <input type="text" placeholder="Answer 1" name="B0tPollAnswer1" id="B0tNewPollAnswer1" minlength="5" maxlength="32">
                <br>
                <input type="text" placeholder="Answer 2" name="B0tPollAnswer2" id="B0tNewPollAnswer2" minlength="5" maxlength="32">
                <?php 
                function B0tAddNewPollAnswer() {
                    if ($_SESSION["B0tAnswareCounter"] <= 8) {
                        $_SESSION["B0tAnswareCounter"]++; 
                    }
                    header("Location: ./");
                    exit();
                };

                for ($i = 3; $i <= $_SESSION["B0tAnswareCounter"]; $i++) {
                    echo "<br> \n" . '<input type="text" placeholder="Answer ' . $i . '" name="B0tPollAnswer' . $i . '" id="B0tNewPollAnswer' . $i . '" minlength="5" maxlength="32"> ';
                }

                if (isset($_POST['B0tNewPollAddAnswerBtn'])) {
                    // Call the PHP function
                    B0tAddNewPollAnswer();
                }
                ?>
                <br>
                <input type="submit" value="Add Answer"  name="B0tNewPollAddAnswerBtn" id="B0tNewPollAddAnswerBtn">
                <br>
                <br>
                <input type="submit" value="Submit" name="B0tNewPollSubmitBtn" id="B0tNewPollSubmitBtn">
            </form>
        </div>
    </div>
</body>
</html>

<!--Collect's information from FORM's-->
<?php 
    function B0tSaveFormData() {
        $B0tGetAnsware = array();

        for ($i = 1; $i <= 9; $i++) {
            $B0tPollAnswares = "B0tPollAnswer" . $i;
            if (isset($_POST[$B0tPollAnswares])) {
                $B0tGetAnsware[] = $_POST[$B0tPollAnswares];
            }
        }
        $B0tAnswareToDB = serialize($B0tGetAnsware);
        $B0tGetPollName = $_POST["B0tPollName"];
        $DB = new Pools;
        $B0tPollID = $DB->B0tGetPollId() ?? 0;
        $B0tPollID++;
        $DB->B0tPollSave($B0tPollID, $B0tGetPollName, $B0tAnswareToDB);
    }
?>