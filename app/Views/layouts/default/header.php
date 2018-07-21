<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Restoran</title>
  <link rel="stylesheet" href="<?php echo $this->base_url('/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo $this->base_url('/css/font-awesome.min.css') ?>">
  <?php 
    /**
     * @type: array
     * Please add the path url
    */
    if(!empty($styles) && is_array($styles)){
      foreach($styles as $style) {
        echo '<link rel="stylesheet" href="' . $style . '">';
      }
    }
  ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Restoran</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto float-right">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $this->base_url('/auth/logout') ?>"><i class="fa fa-power-off"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">