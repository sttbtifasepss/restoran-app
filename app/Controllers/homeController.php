<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class HomeController extends Controller {
    public function index () {
      
      $this->view('layouts/header', [
        'styles' => [
          $this->base_url('/css/style.css')
        ]
      ]);
      $this->view('home', [
        'title' => 'Home'
      ]);
      $this->view('layouts/footer');
      
      
    }
  }
  