<?php 

  class user extends Database {

    public function __construct() {
      parent::__construct();
    }

    public function me($id) {
      $db = self::$db->prepare('SELECT * FROM users where id = ' . $id);
      $db->execute();
      return $db->fetch(PDO::FETCH_OBJ);
    }

    public function login($nip, $password) {
      $db = self::$db->prepare('SELECT * FROM users WHERE nip = "' . $nip . '" AND password = "' . $password . '"');
      $db->execute();
      $fetch = $db->fetch(PDO::FETCH_OBJ);
      if($fetch) {
        $_SESSION['__LOGIN__'] = ($fetch);
      } 
      return $fetch;

    }

  }
  