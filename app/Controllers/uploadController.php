<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class uploadController extends Controller {
    
    public function index () {
      $dbFile = $this->model('files');

      $dbFile->create([
        'filename' => 'Test file name'
      ]);
      
      $this->view('layouts/header', [ 'title' => 'Upload File' ]);
      $this->view('tugas/upload/index');
      $this->view('layouts/footer');
    }

    public function store () {
      $file = $this->file('files');
      if($file) {
        move_uploaded_file($file['tmp_name'], $this->storage_path('/public/' . $file['new_name']));
      }
      $this->redirect('/upload');
    }

  }
  