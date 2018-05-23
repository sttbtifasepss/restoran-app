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
      ],
      'Daftar Menu' => [
        'link' => $this->base_url('/admin/menus'),
        'icon' => 'menu-icon icon-format_list_bulleted'
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

  public function menus () {
    $menu = $this->model('menu');
    $this->titlePage = 'Daftar Menu';

    $menus = $menu->select('menus', ['*'], 'WHERE status = 1');
    $data['menus'] = $menus;
    
    $this->view('layouts/login/header', [
      'styles' => [
        $this->base_url('plugins/datatables/css/datatables.bootstrap.min.css'),
        $this->base_url('plugins/fancybox/jquery.fancybox.min.css')
      ],
      'scripts' => [
        $this->base_url('plugins/datatables/js/jquery.datatables.min.js'),
        $this->base_url('plugins/datatables/js/datatables.bootstrap.min.js'),
        $this->base_url('plugins/fancybox/jquery.fancybox.min.js')
      ]
    ]);
    $this->view('admin/menus/index', $data);
    $this->view('layouts/login/footer');
  }

  public function tambah_menus () {

    $this->titlePage = 'Tambah Menu';
    $this->view('layouts/login/header');
    $this->view('admin/menus/tambah');
    $this->view('layouts/login/footer');
  }


  public function edit_menus (INT $id = 0) {
    $menu = $this->model('menu');

    $this->titlePage = 'Edit Menu';
    
    $menu = $menu->select('menus', ['*'], 'WHERE id = ' . $id);
    $data['menu'] = $menu->fetch();

    $this->view('layouts/login/header');
    $this->view('admin/menus/edit', $data);
    $this->view('layouts/login/footer');
  }

  public function save_edit_menus() {
    $menu = $this->model('menu');
    $file = $this->file('image');
    
    if($file) {
      move_uploaded_file($file['tmp_name'], $this->public_path('img/menus/' . $file['new_name']));
      $update['url_gambar'] = '/img/menus/' . $file['new_name'];

      if(file_exists($this->public_path($this->req('url_image')))){
        @unlink($this->public_path($this->req('url_image')));
      }
    }

    $update['nama_menu'] = $this->req('nama_menu');
    $update['harga'] = $this->req('harga');
    $update['keterangan'] = $this->req('keterangan');
    $update['id'] = $this->req('id');

    $save = $menu->update('menus', $update, 'WHERE id = :id');

    if($save){
      $this->flash('success', [
        $this->req('nama_menu') . ' berhasil diperbaharui!'
      ]);
      return $this->redirect('/admin/edit_menus/' . $this->req('id'));
    }
    $this->flash('errors', [
      'Ada kesalahan saat memperbaharui menu!'
    ]);
    return $this->redirect('/admin/edit_menus/' . $this->req('id'));
  }
  
  public function save_menus () {
    $menu = $this->model('menu');
    $file = $this->file('image');
    if($file) {

      $save = $menu->insert('menus', [
        'nama_menu' => $this->req('nama_menu'),
        'harga' => $this->req('harga'),
        'keterangan' => $this->req('keterangan'),
        'url_gambar' => '/img/menus/' . $file['new_name']
      ]);
      
      if($save){
        move_uploaded_file($file['tmp_name'], $this->public_path('img/menus/' . $file['new_name']));
        $this->flash('success', [
          $this->req('nama_menu') . ' berhasil ditambahkan!'
        ]);
        return $this->redirect('/admin/menus');
      }
      $this->flash('errors', [
        'Ada kesalahan saat manambahkan menu!'
      ]);
      return $this->redirect('/admin/tambah_menus');
      
    }
  }

  public function destroy ($id) {
    $menu = $this->model('menu');
    $save = $menu->update('menus', [
      'status' => 0,
      'id' => $id
    ], 'WHERE id = :id');

    if($save){
      echo json_encode([
        'result' => true,
        'message' => 'Menu berhasil dihapus!'
      ]);
      exit;
    }
    echo json_encode([
      'result' => false,
      'message' => 'Ada kesalahan saat menghapus menu!'
    ]);
  }

}
