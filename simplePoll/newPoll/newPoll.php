<?php 
    session_start();

    
    if (!isset($_SESSION["B0tAnswareCounter"])) {
        $_SESSION["B0tAnswareCounter"] = 2;
    }
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
                <p>Please enter your email</p>
                <input type="email" placeholder="example@example.com" name="B0tAutoherEmail" id="B0tNewPollCreaterEmail" maxlength="255">
                <p>Poll Name</p>
                <input type="text" placeholder="Poll Name" name="pollName" id="B0tNewPollName" minlength="5" maxlength="64">
                <p>Answers</p>
                <input type="text" placeholder="Answer 1" name="Answer1" id="B0tNewPollAnswer1" minlength="5" maxlength="32">
                <br>
                <input type="text" placeholder="Answer 2" name="Answer2" id="B0tNewPollAnswer2" minlength="5" maxlength="32">
                <?php 
                

                function B0tAddNewPollAnswer() {
                    if ($_SESSION["B0tAnswareCounter"] <= 9) {
                        $_SESSION["B0tAnswareCounter"]++; 
                    }
                };
                for ($i=2; $i < ($_SESSION["B0tAnswareCounter"]); $i++){
                    echo "<br> \n" . '<input type="text" placeholder="Answer ' . $i + 1 . '" name="Answer' . $i + 1 . '" id="B0tNewPollAnswer' . $i + 1 . '" minlength="5" maxlength="32"> ';
                }
                if (isset($_POST['B0tNewPollAddAnswerBtn'])) {
                    // Call the PHP function
                    B0tAddNewPollAnswer();
                }

                ?>
                <br>
                <input type="button" value="Add Answer"  name="B0tNewPollAddAnswerBtn" id="B0tNewPollAddAnswerBtn" >
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
        $answerKey = "Answer" . $i;
        if (isset($_POST[$answerKey])) {
            $B0tGetAnsware[] = $_POST[$answerKey];
        }
    }
    $B0tGetPollName = $_POST["pollName"];
    $B0tGetPollEmail = $_POST["email"];

};

if (isset($_POST['B0tNewPollSubmitBtn'])) {
    // Call the PHP function
    B0tSaveFormData();
};


?>
