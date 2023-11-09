<?php 
    ini_set('session.cookie_lifetime', 900);
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    
    if (!isset($_SESSION["B0tAnswareCounter"])) {
        $_SESSION["B0tAnswareCounter"] = 2;
    };
    require "./addNewPollToDB.php";

    if (isset($_POST['B0tNewPollSubmitBtn'])) {
        // Call the PHP function
        B0tSaveFormData();
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
    <link rel="stylesheet" href="./newPoll.css">
</head>
<body>
    <div class="container">
        <div>
            <h1>New Poll Creator</h1>
        </div>
        <div>
            <form method="POST">
                <p>Please enter your email</p>
                <input type="email" placeholder="example@example.com" name="B0tPollAutorEmail" id="B0tNewPollCreaterEmail" maxlength="255">
                <p>Poll Name</p>
                <input type="text" placeholder="Poll Name" name="B0tPollName" id="B0tNewPollName" minlength="5" maxlength="64">
                <p>Answers</p>
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