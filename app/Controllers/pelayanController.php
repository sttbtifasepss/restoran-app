<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pelayanController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan != 'Pelayan')
      $this->abort(404);


    // Set menu
    $this->menus = [
      'Daftar Menus' => [
        'link' => $this->base_url('/pelayan'),
        'icon' => 'menu-icon icon-home4'
      ]
    ];
  }

  // public function index () {
  //   $data['user'] = $this->user();
  //   $this->titlePage = 'Pelayan Dashboard';
  //   $this->view('layouts/login/header', [
  //     'title' => 'Halaman Pelayan'
  //   ]);
  //   $this->view('member/pelayan', $data);
  //   $this->view('layouts/login/footer');
  // }

  public function index () {
    $menu = $this->model('menu');
    $this->titlePage = 'Daftar Menu';

    $menus = $menu->select('menus', ['*'], 'WHERE status = 1');
    $data['menus'] = $menus;
    
    $this->view('layouts/login/header', [
      'styles' => [
        $this->base_url('plugins/fancybox/jquery.fancybox.min.css')
      ],
      'scripts' => [
        $this->base_url('plugins/fancybox/jquery.fancybox.min.js')
      ]
    ]);
    $this->view('pelayan/menus/menu', $data);
    $this->view('layouts/login/footer');
  }

}
