<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kokiController extends Controller  {

  public function __construct() {
    
    if(!$this->user() || $this->user()->jabatan !== 'Koki')
      $this->abort(404);
  }

  public function index () {
    $data['user'] = $this->user();

    $this->view('layouts/header', [
      'title' => 'Halaman Koki'
    ]);
    $this->view('member/koki', $data);
    $this->view('layouts/footer');
  }
}
