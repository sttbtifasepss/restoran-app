<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 trait HelperTrait {

  public function req($name) {
    if(!empty($_REQUEST[$name])) {
      $type = $_SERVER['REQUEST_METHOD'] === 'POST' ? INPUT_POST : INPUT_GET;
      return trim($_REQUEST[$name]);
    }
  }

  public function file ($file) {
    if(!empty($_FILES[$file]['tmp_name'])){
      $_FILES[$file]['ext'] = '.' . explode('.', $_FILES[$file]['name'])[1];
      $_FILES[$file]['new_name'] = date('Y_m_d_h_i_s_') . md5(uniqid() . time()) . '.' . explode('.', $_FILES[$file]['name'])[1];
      return $_FILES[$file];
    }

    return false;
  }

  public function base_url($path){
    $app = new Config();
    return 'http://' . $_SERVER['HTTP_HOST'] . rtrim($app->basePath, '/') . '/' . ltrim($path, '/');
  }

  public function redirect($path){
    echo '<meta http-equiv="refresh" content="0; url=' . $this->base_url($path) . '" />';
  }

  public function storage_path($path = '') {
    return __DIR__ . '/../Storage' . '/' . ltrim($path);
  }
  public function public_path($path) {
    return __DIR__ . '/../public' . '/' . ltrim($path);
  }

  public function flash($name, $data = []){
    try{
      if(!is_array($data))
        throw new Exception("Error:Flash: Data harus berupa array", 1);
        
        $lists = !empty($_SESSION['listFlash']) ? json_decode($_SESSION['listFlash']) : [];

        $_SESSION[$name] = json_encode($data);
        
        if(count($lists) > 0){
          foreach($lists as $list){
            if($list !== $name)
              array_push($lists, $name);
          }
        }else{
          $lists = [$name];
        }
        $_SESSION['listFlash'] = json_encode($lists);

    } catch(Exception $e) {
      die($e->getMessage());
    } 
  }

  public function sessionFlash($name) {
    return empty($_SESSION[$name]) ? null : json_decode($_SESSION[$name]);
  }

  public function remove_flash() {
    if(!empty($_SESSION['listFlash'])){
        foreach(json_decode($_SESSION['listFlash']) as $flash){
          unset($_SESSION[$flash]);
        }
      }
  }

  public function user() {

    $user = $this->model('user');

    if(!empty($_SESSION['__LOGIN__'])){
      $sessionUser = $_SESSION['__LOGIN__'];
      return $user->me($sessionUser->id);
    }else {
      return null;
    }
  }

  public function isAdmin() {
    $user = $this->model('user');
    if(!empty($_SESSION['__LOGIN__'])){
      $sessionUser = $_SESSION['__LOGIN__'];
      $me = $user->me($sessionUser->id);
      return $me->jabatan === 'Admin' ? true : false;
    }else {
      return false;
    }
  }

  public function abort($view) {
    $this->view('errors/' . $view);
    exit;
  }

 }
 

