<?php
class Pools {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo;
  private $stmt;
  public $error;
  function __construct() {
    $this->pdo = new PDO(
      "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }

  // (C) SAVE FORM

  // Find the the higest id in the database, and create a new one
  function B0tGetPollId($B0tDBPollId) {
    $this->stmt = $this->pdo->prepare(
      "SELECT MAX(`pollId`) FROM `Polls`"
    );
    $_SESSION["B0tDBPollID"] = $B0tDBPollId;
    print_r($_SESSION["B0tDBPollID"]);
    $this->stmt->execute();
    return $this->stmt->fetchColumn();
}


  //save all the data to the database
  
  function B0tPollSave ($B0tPollId, $B0tGetPollName, $name, $B0tGetAnsware, $date=null) {
    $B0tPollId = ++ $_SESSION["B0tDBPollID"];
    if ($date==null) { $date = date("Y-m-d H:i:s"); }
    try {
      $this->stmt = $this->pdo->prepare(
        "REPLACE INTO `Polls` (`pollId`, `pollQustion`, `pollAnswer`, `pollAnswerVotes`, `pollStatus`, `datetime`) VALUES (?,?,?,?,?)"
      );
      $this->stmt->execute([$B0tPollId, $B0tGetPollName, $name, $B0tGetAnsware, $date]);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
}

// (E) DATABASE SETTINGS - CHANGE TO YOUR OWN !
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "pools");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", null);

// (F) NEW GUEST BOOK OBJECT
$_GB = new Pools();