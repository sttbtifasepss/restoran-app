<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan !== 'Admin')
      $this->abort(404);
  }
  
  public function index () {
    $data['user'] = $this->user();

    $this->view('layouts/login/header', [
      'title' => 'Halaman Admin'
    ]);
    $this->view('member/admin', $data);
    $this->view('layouts/login/footer');
  }
}
