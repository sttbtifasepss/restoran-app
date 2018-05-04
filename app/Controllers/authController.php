<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class authController extends Controller {

  private $user;

  public function __construct() {
    $this->user = $this->model('user');
  }

  public function index() {
    
    $this->view('layouts/default/header',[
      'title' => 'Halaman Login',
      'styles' => [
        $this->base_url('/css/modules/auth/login.css')
      ]
    ]);
    $this->view('auth/login');
    $this->view('layouts/default/footer');

  }

  public function store_auth() {
    
    try{
      if(empty($this->req('nip')))
        throw new Exception("NIP tidak boleh kosong", 1);
      
      if(empty($this->req('password')))
        throw new Exception("Password tidak boleh kosong", 1);
      
      if($this->user->login($this->req('nip'), $this->req('password'))) {
        switch($this->user()->jabatan):
          case"Kasir":
            $this->redirect('/kasir');
          break;
          case"Pelayan":
            $this->redirect('/pelayan');
          break;
          case"Koki":
            $this->redirect('/koki');
          break;
          case"Admin":
            $this->redirect('/admin');
          break;
        endswitch;
      }else{
        throw new Exception("NIP atau password tidak cocok!", 1);
      }
    }catch(Exception $e) {
      $this->flash('errors', [
        $e->getMessage()
      ]);
      $this->redirect('/auth/login');
    }

  }

  public function logout() {
    unset($_SESSION['__LOGIN__']);
    $this->redirect('/auth/login');
  }

}
