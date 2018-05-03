<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pelayanController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan !== 'Pelayan')
      $this->abort(404);
  }

  public function index () {
    echo 'Pelayan';
  }
}
