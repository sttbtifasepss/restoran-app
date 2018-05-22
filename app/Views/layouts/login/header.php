<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Space - Responsive Admin Dashboard Template</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="<?php echo $this->base_url('plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo $this->base_url('plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link href="<?php echo $this->base_url('plugins/icomoon/style.css') ?>" rel="stylesheet">
        <link href="<?php echo $this->base_url('plugins/uniform/css/default.css') ?>" rel="stylesheet"/>
        <link href="<?php echo $this->base_url('plugins/switchery/switchery.min.css') ?>" rel="stylesheet"/>
      
        <!-- Theme Styles -->
        <link href="<?php echo $this->base_url('css/space.min.css') ?>" rel="stylesheet">
        <link href="<?php echo $this->base_url('css/themes/admin3.css') ?>" rel="stylesheet">
        <link href="<?php echo $this->base_url('css/custom.css') ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
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

  <!-- Page Container -->
  <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="<?php echo $this->base_url('/') ?>">
                    <span>RESTORAN</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <?php foreach($this->menus as $menu => $attr): ?>
                            <li>
                                <a href="<?php echo $attr['link'] ?>">
                                    <i class="<?php echo $attr['icon'] ?>"></i><span><?php echo $menu ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->
            
            <!-- Page Content -->
            <div class="page-content">            
                <!-- Page Header -->
                <div class="page-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <div class="logo-sm">
                                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                                    <a class="logo-box" href="index.html"><span>Space</span></a>
                                </div>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </div>
                        
                            <!-- Collect the nav links, forms, and other content for toggling -->
                        
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
                                    <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            Hi, <?php echo $this->user()->nama ?> &nbsp; &nbsp; &nbsp;
                                            <img src="<?php echo $this->base_url('img/avatar.jpg') ?>" alt="" class="img-circle">
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- <li><a href="#">Profile</a></li>
                                            <li role="separator" class="divider"></li> -->
                                            <li><a href="<?php echo $this->base_url('/auth/logout') ?>">Log Out</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div><!-- /Page Header -->
                <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header"><?php echo $this->titlePage ?></h3>
                    </div>
                <div id="main-wrapper">
                    <div class="row">