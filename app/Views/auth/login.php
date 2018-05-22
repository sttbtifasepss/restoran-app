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
        <title>Login - Restorant</title>

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
    </head>
    <body>
        
        <!-- Page Container -->
        <div class="page-container" style="overflow:hidden;">
                <!-- Page Inner -->
                <div class="page-inner login-page">
                    <div id="main-wrapper" class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 login-box">
                                <h4 class="login-title">Masuk</h4>

                                <?php if(!empty($this->sessionFlash('errors'))): ?>
                                  <div class="alert alert-warning">
                                    <ul>
                                      <?php foreach($this->sessionFlash('errors') as $error): ?>
                                        <li><?php echo $error; ?></li>
                                      <?php endforeach; ?>
                                    </ul>
                                  </div>
                                <?php endif; ?>

                                <form action="<?php echo $this->base_url('/auth/store_auth') ?>" method="post">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip" id="npm" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div><!-- /Page Content -->

            <img src="<?php echo $this->base_url('/img/splash.png') ?>" class="image-splash">
        </div><!-- /Page Container -->
        
        <!-- Javascripts -->
        <script src="<?php echo $this->base_url('plugins/jquery/jquery-3.1.0.min.js') ?>"></script>
        <script src="<?php echo $this->base_url('plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo $this->base_url('plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
        <script src="<?php echo $this->base_url('plugins/uniform/js/jquery.uniform.standalone.js') ?>"></script>
        <script src="<?php echo $this->base_url('plugins/switchery/switchery.min.js') ?>"></script>
        <script src="<?php echo $this->base_url('js/space.min.js') ?>"></script>
    </body>
</html>
<?php $this->remove_flash(); ?>