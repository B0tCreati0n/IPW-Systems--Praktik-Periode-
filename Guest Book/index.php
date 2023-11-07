<?php
// (A) PAGE INIT
// (A1) LOAD LIBRARY + SET PAGE ID
// GIVE EVERY PAGE A "UNIQUE ID"
// OR JUST USE "1" FOR A SINGLE GUESTBOOK FOR THE ENTIRE SITE
require "2-lib.php";
$pid = 1;
 
// (A2) SAVE GUEST BOOK ENTRY
if (isset($_POST["name"])) {
  if ($_GB->save($pid, $_POST["email"], $_POST["name"], $_POST["comment"])) {
    echo "<div class='note'>Guest Book Entry Saved</div>";
  } else {
    echo "<div class='note'>$_GB->error</div>";
  }
}
 
// (A3) GET GUEST BOOK ENTRIES
$entries = $_GB->get($pid); ?>
 
<!-- (B) GUEST BOOK ENTRIES -->
<div id="gb-entries">
  <?php if (count($entries)>0) { foreach ($entries as $e) { ?>
  <div class="gb-row">
    <img class="gb-ico" src="talk.png">
    <div class="gb-msg">
      <div class="gb-comment"><?=$e["comment"]?></div>
      <div class="gb-name"><?=$e["name"]?></div>
      <div class="gb-date"> &#x2022; <?=$e["datetime"]?></div>
    </div>
  </div>
  <?php }} ?>
</div>
 
<!-- (C) ADD NEW ENTRY -->
<form method="post" target="_self" id="gb-form">
  <textarea name="comment" placeholder="Comment" required></textarea>
  <input type="text" name="name" placeholder="Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="submit" value="Sign Guestbook">
</form>