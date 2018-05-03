<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kasirController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan !== 'Kasir')
      $this->abort(404);
  }

  public function index () {
    echo 'Kasir';
  }
}
