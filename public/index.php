<?php 
  ob_start();
  session_start();
  require_once __DIR__ . '/../init.php';
  $route = new Route();