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
      ],
      'Laporan Pesanan' => [
        'link' => $this->base_url('/admin/laporanpesanan'),
        'icon' => 'menu-icon fa fa-file'
      ],
      'Laporan Pembalian' => [
        'link' => $this->base_url('/admin/laporanpembelian'),
        'icon' => 'menu-icon fa fa-cubes'
      ],
      'Grafik Pendapatan' => [
        'link' => $this->base_url('/admin/laporanchart'),
        'icon' => 'menu-icon fa fa-line-chart'
      ]
    ];
  }
  
  public function index () {
    $order = $this->model('order');
    $data['user'] = $this->user();

    $income = $order->select('order_detail', ['SUM(order_detail.harga) as income'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
    $data['income'] = $income->fetch();

    $terjual = $order->select('order_detail', ['COUNT(order_detail.harga) as jumlah'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
    $data['terjual'] = $terjual->fetch();

    $unpaid = $order->select('order_detail', ['SUM(order_detail.harga) as total'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "unpaid" AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
    $data['unpaid'] = $unpaid->fetch();

    $data['cpendapatan'] = [];
    $data['cterjual'] = [];
    for($i = 1; $i < 13; $i++) {
      $items = $order->select('order_detail', ['SUM(order_detail.harga) as total'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" AND MONTH(orders.tgl_order) = ' . $i . ' AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
      $item = $items->fetch();
      $data['cpendapatan'][] = $item['total'] ? (FLOAT) $item['total'] : 0;

      $itemsa = $order->select('order_detail', ['COUNT(order_detail.harga) as total'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" AND MONTH(orders.tgl_order) = ' . $i . ' AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
      $itema = $itemsa->fetch();
      $data['cterjual'][] = $itema['total'] ? (FLOAT) $itema['total'] : 0;
    }
    
    $this->titlePage = 'Admin Dashboard';
    $this->view('layouts/login/header', [
      'scripts' => [
        $this->base_url('js/chart.bundle.min.js')
      ]
    ]);
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


  public function edit_menus ($id = 0) {
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

  public function laporanpesanan () {

    $data = [];

    $orders = $this->model('order');
    $data['items'] = $orders->select('order_detail', ['orders.*', 'SUM(order_detail.harga) as grandtotal'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" GROUP BY orders.id ORDER BY orders.id ASC');
    $this->titlePage = 'Laporan Pesanan';
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
    $this->view('admin/laporan', $data);
    $this->view('layouts/login/footer');
  }

  public function laporanpembelian () {

    $data = [];

    $orders = $this->model('order');
    $data['items'] = $orders->select('order_detail', 
      [
        'menus.*',
        'orders.tgl_order',
        'orders.no_order',
        'order_detail.harga'
      ], 
      'INNER JOIN orders ON orders.id = order_detail.order_id
      INNER JOIN menus ON menus.id = order_detail.menu_id 
      WHERE orders.status_bayar = "paid"
      ORDER BY order_detail.id ASC
    ');
    $this->titlePage = 'Laporan Pesanan';
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
    $this->view('admin/laporanpembelian', $data);
    $this->view('layouts/login/footer');
  }

  public function laporanchart () {

    $data = [];

    $orders = $this->model('order');
    $data['items'] = $orders->select('order_detail', 
      [
        'menus.*',
        'orders.tgl_order',
        'orders.no_order',
        'order_detail.harga'
      ], 
      'INNER JOIN orders ON orders.id = order_detail.order_id
      INNER JOIN menus ON menus.id = order_detail.menu_id 
      WHERE orders.status_bayar = "paid"
      ORDER BY order_detail.id ASC
    ');
    $this->titlePage = 'Grafik Pendapatan Tahun ' . date('Y');
    $this->view('layouts/login/header', [
      'scripts' => [
        $this->base_url('js/chart.bundle.min.js')
      ]
    ]);
    $this->view('admin/laporanchart', $data);
    $this->view('layouts/login/footer');
  }

  public function datachart () {
    $orders = $this->model('order');

    $data = [];
    for($i = 1; $i < 13; $i++) {
      $items = $orders->select('order_detail', ['SUM(order_detail.harga) as grandtotal'], 'INNER JOIN orders ON orders.id = order_detail.order_id WHERE orders.status_bayar = "paid" AND MONTH(orders.tgl_order) = ' . $i . ' AND YEAR(orders.tgl_order) = ' . date('Y') . ' GROUP BY orders.id');
      $item = $items->fetch();
      $data[] = $item['grandtotal'] ? (FLOAT) $item['grandtotal'] : 0;
    }

    echo json_encode($data);
  }

}
