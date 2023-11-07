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
            <form method="post" id="B0tNewPollForm">
                <p>Please enter your email</p>
                <input type="email" placeholder="example@example.com" name="Email" id="B0tNewPollCreaterEmail" maxlength="255">
                <p>Poll Name</p>
                <input type="text" placeholder="Poll Name" name="Poll Name" id="B0tNewPollName" minlength="5" maxlength="64">
                <p>Answers</p>
                <input type="text" placeholder="Answer 1" name="Answer 1" id="B0tNewPollAnswer1" minlength="5" maxlength="32">
                <br>
                <input type="text" placeholder="Answer 2" name="Answer 2" id="B0tNewPollAnswer2" minlength="5" maxlength="32">
                <br>
                <input type="button" value="Add Answer" id="B0tNewPollAddAnswerBtn">
                <br>
                <br>
                <input type="button" value="Submit" id="B0tNewPollSubmitBtn">
            </form>
        </div>
    </div>
</body>
</html>
