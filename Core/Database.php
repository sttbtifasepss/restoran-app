<?php 

  class Database {
      
    /* PROTECTED AREA */
    public static $db = null;
    public $lastid;
    public function __construct() {
      $config = new Config();
      self::$db = new PDO($config->driver . ':host=' . $config->host . ';dbname=' . $config->database, $config->user, $config->password);
    }

    public static function connect() {
      if(self::$db){
        self::$db = new Database();
      }

      return self::instance();
    }

    public function insert ($table, $data = []) {
      $fields = '';
      $values = '';
      foreach($data as $field => $value) {
        $fields .= $field . ',';
        $values .= ':' . $field . ',';
      }
      $statement = self::$db->prepare('INSERT INTO ' . $table . '(' . rtrim($fields, ',') . ')VALUE(' . rtrim($values, ',') . ')');
      $excute = $statement->execute($data);
      $this->lastid = self::$db->lastInsertId();
      return $excute;
    }

    public function update ($table, $data = [], $condition = '') {
      $fields = '';
      foreach($data as $field => $value) {
        $fields .= $field . ' = :' . $field . ',';
      }
      
      $statement = self::$db->prepare('UPDATE ' . $table . ' SET ' . rtrim($fields, ',') . ' ' . $condition);
      return $statement->execute($data);
    }
    
    public function select($table, $fields = ['*'], $condition = '') {
      $select = '';
      foreach($fields as $field) {
        $select .= $field . ',';
      }

      $sql = 'SELECT ' . rtrim($select, ',') . ' FROM ' . $table . ' ' . $condition;
      return self::$db->query($sql);
    }

  }
  