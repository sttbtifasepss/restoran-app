<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kokiController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan != 'Koki')
      $this->abort(404);


    // Set menu
    $this->menus = [
      'Dasboard' => [
        'link' => $this->base_url('/koki'),
        'icon' => 'menu-icon icon-home4'
      ]
    ];
  }

  public function index () {
    $data['user'] = $this->user();
    $this->titlePage = 'Koki Dashboard';
    $this->view('layouts/login/header', [
      'title' => 'Halaman Koki'
    ]);
    $this->view('member/koki', $data);
    $this->view('layouts/login/footer');
  }
}
