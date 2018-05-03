<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan !== 'Admin')
      $this->abort(404);
  }
  
  public function index () {
    echo 'Admin';
  }
}
