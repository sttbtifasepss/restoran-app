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
      'styles' => [
        $this->base_url('plugins/fancybox/jquery.fancybox.min.css')
      ],
      'scripts' => [
        $this->base_url('plugins/fancybox/jquery.fancybox.min.js')
      ]
    ]);
    $this->view('member/koki', $data);
    $this->view('layouts/login/footer');
  }

  public function orders() {
    $orders = $this->model('order');
    $items = $orders->select('orders', ['*'], 'WHERE status_bayar = "unpaid" AND status <> "selesai" ORDER BY id DESC');
    $out = [];
    foreach($items as $item) {
      $out[] = [
        'id' => $item['id'],
        'no_order' => $item['no_order'],
        'nama_pelanggan' => $item['nama_pelanggan'],
        'tgl_order' => date('d F Y H:1 A', strtotime($item['tgl_order'])),
        'total' => $item['total'],
        'status_bayar' => $item['status_bayar'],
        'status' => $item['status'],
        'no_meja' => $item['no_meja'],
      ];
    }

    echo json_encode($out);
  }

  public function detail($id) {
    $orders = $this->model('order');
    $items = $orders->select('order_detail', ['*'], 'INNER JOIN menus ON menus.id = order_detail.menu_id WHERE order_detail.order_id = ' . $id);
    $out = [];
    foreach($items as $item) {
      $out[] = [
        'id' => $item['id'],
        'harga' => $item['harga'],
        'url_gambar' => $this->base_url($item['url_gambar']),
        'nama_menu' => $item['nama_menu'],
        'keterangan' => $item['keterangan']
      ];
      
    }

    echo json_encode($out);
  }

  public function selesai() {
    $params = json_decode(file_get_contents('php://input'));
    $orders = $this->model('order');
    // echo '<pre>';
    // print_r($params);
    // exit;
    $update = $orders->update('orders', [
      'status' => 'selesai',
    ], 'WHERE id = ' . $params->id);

    if($update) {
      echo json_encode([
        'result' => true,
        'message' => 'Pesanan berhasil diselesaikan'
      ]);
    } else {
      echo json_encode([
        'result' => false
      ]);
    }


  }

}
