<?php
  define('BASEPATH', '');
  spl_autoload_register(function ($class) {
    require_once __DIR__ . '/Core/' . $class . '.php';
  });