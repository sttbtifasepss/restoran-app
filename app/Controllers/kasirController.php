<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kasirController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan != 'Kasir')
      $this->abort(404);


    // Set menu
    $this->menus = [
      'Dasboard' => [
        'link' => $this->base_url('/kasir'),
        'icon' => 'menu-icon icon-home4'
      ]
    ];
  }

  public function index () {
    $data['user'] = $this->user();
    $this->titlePage = 'Kasir Dashboard';
    $this->view('layouts/login/header', [
      'title' => 'Halaman Kasir'
    ]);
    $this->view('member/kasir', $data);
    $this->view('layouts/login/footer');
  }
}
