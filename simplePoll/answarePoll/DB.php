<?php
class B0tGetPollFromDB {
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

  // (C) GET GUEST BOOK ENTRIES
  function B0tGetPollFromId ($B0tReqPollId) {
        $this->stmt = $this->pdo->prepare(
          "SELECT * FROM `pollqustions` WHERE `post_id`=? ORDER BY `datetime` DESC"
        );
        $this->stmt->execute([$B0tReqPollId]);
        return $this->stmt->fetchall();
  }
}

// (E) DATABASE SETTINGS - CHANGE TO YOUR OWN !
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "guest book");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", null);

// (F) NEW GUEST BOOK OBJECT
$_GB = new GuestBook();