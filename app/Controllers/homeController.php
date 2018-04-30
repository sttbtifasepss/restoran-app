<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class HomeController extends Controller {
    public function index () {
      
      $this->view('home', [
        'title' => 'Home'
      ]);
      
    }
  }
  