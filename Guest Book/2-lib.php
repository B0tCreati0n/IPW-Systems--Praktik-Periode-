<?php
class GuestBook {
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
  function get ($pid) {
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `guestbook` WHERE `post_id`=? ORDER BY `datetime` DESC"
    );
    $this->stmt->execute([$pid]);
    return $this->stmt->fetchall();
  }

  // (D) SAVE GUEST BOOK ENTRY
  function save ($pid, $email, $name, $comment, $date=null) {
    if ($date==null) { $date = date("Y-m-d H:i:s"); }
    try {
      $this->stmt = $this->pdo->prepare(
        "REPLACE INTO `guestbook` (`post_id`, `email`, `name`, `comment`, `datetime`) VALUES (?,?,?,?,?)"
      );
      $this->stmt->execute([$pid, $email, $name, strip_tags($comment), $date]);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
}

// (E) DATABASE SETTINGS - CHANGE TO YOUR OWN !
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (F) NEW GUEST BOOK OBJECT
$_GB = new GuestBook();