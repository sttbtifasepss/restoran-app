<?php 

  class files extends Database {

    protected $table = 'files';

    public function __construct() {
      parent::__construct();
    }

    public function create($data) {
      $this->insert($this->table, $data);
    }


  }
  