<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Route {
    
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
      $url[0] = $this->controller;
      if(isset($_GET['url'])){
        $url = explode('/', filter_var(trim($_GET['url']), FILTER_SANITIZE_URL));
      }

      $url[0] = $url[0] . 'Controller';

      if (file_exists( __DIR__ . '/../app/Controllers/' . $url[0] . '.php')) {
        $this->controller = $url[0];
      }
      require_once __DIR__ . '/../app/Controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;

      if(isset($url[1])){
        if(method_exists($this->controller, $url[1])){
          $this->method = $url[1];
        }
      }
      unset($url[0]);
      unset($url[1]);
      array_values($url);

      call_user_func_array([$this->controller, $this->method], $this->params);
    }

  }
  