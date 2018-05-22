<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminController extends Controller  {

  public function __construct() {
    if(!$this->user() || $this->user()->jabatan !== 'Admin')
      $this->abort(404);

    // Set menu
    $this->menus = [
      'Dasboard' => [
        'link' => $this->base_url('/admin'),
        'icon' => 'menu-icon icon-home4'
      ]
    ];
  }
  
  public function index () {
    $data['user'] = $this->user();
    $this->titlePage = 'Admin Dashboard';
    $this->view('layouts/login/header');
    $this->view('member/admin', $data);
    $this->view('layouts/login/footer');
  }
}
