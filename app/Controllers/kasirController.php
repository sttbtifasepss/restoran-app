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

  public function orders() {
    $orders = $this->model('order');
    $items = $orders->select('orders', ['*'], 'WHERE status_bayar = "unpaid" ORDER BY id DESC');
    $out = [];
    foreach($items as $item) {
      $out[] = [
        'id' => $item['id'],
        'no_order' => $item['no_order'],
        'nama_pelanggan' => $item['nama_pelanggan'],
        'tgl_order' => date('d F Y H:1 A', strtotime($item['tgl_order'])),
        'total' => $item['total'],
        'status_bayar' => ucwords($item['status_bayar']),
        'status' => ucwords($item['status']),
        'no_meja' => $item['no_meja'],
      ];
    }

    echo json_encode($out);
  }

  public function detail($id) {
    $orders = $this->model('order');
    $items = $orders->select('order_detail', ['*'], 'INNER JOIN menus ON menus.id = order_detail.menu_id WHERE order_detail.order_id = ' . $id);
    $out = [];
    $total = 0;
    foreach($items as $item) {
      $out[] = [
        'id' => $item['id'],
        'harga' => number_format($item['harga'], 2,',','.'),
        'url_gambar' => $this->base_url($item['url_gambar']),
        'nama_menu' => $item['nama_menu'],
        'keterangan' => $item['keterangan']
      ];

      $total += $item['harga'];
    }

    $result = [
      'total_bayar' => number_format($total,2,',','.'),
      'items' => $out
    ];

    echo json_encode($result);
  }

}
