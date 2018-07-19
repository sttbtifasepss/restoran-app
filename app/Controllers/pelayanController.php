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

  public function items () {
    $menu = $this->model('menu');
    $menus = $menu->select('menus', ['*'], 'WHERE status = 1');
    $items = [];
    foreach($menus as $menu) {
      $items[] = [
        'id' => $menu['id'],
        'harga' => $menu['harga'],
        'url_gambar' => $this->base_url($menu['url_gambar']),
        'nama_menu' => $menu['nama_menu'],
        'keterangan' => $menu['keterangan']
      ];

    }
    echo json_encode($items);
  }
  public function proses () {
    $params = json_decode(file_get_contents('php://input'));
    
    $order = $this->model('order');
    $noinvoice = rand(11111111,99999999);

    $save = $order->insert('orders', [
      'no_order' => $noinvoice,
      'nama_pelanggan' => 'Pelanggan',
      'tgl_order' => date('Y-m-d H:i:s'),
      'total' => 0,
      'status_bayar' => 'unpaid',
      'status' => 'Antrian Masak',
      'no_meja' => $params->no
    ]);

    if($save) {
      $id = $order->lastid;

      foreach($params->items as $item) {
        $data = [
          'order_id' => $id,
          'menu_id' => $item->id,
          'qty' => 1,
          'harga' => $item->harga
        ];
        $order->insert('order_detail', $data);
      }

      echo json_encode([
        'result' => true,
        'message' => 'Pesanan berhasil di tambahkan dengan No Order #' . $noinvoice
      ]);
    } else {
      echo json_encode([
        'result' => false
      ]);
    }
  }

}
