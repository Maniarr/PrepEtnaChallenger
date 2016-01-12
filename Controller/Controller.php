<?php

class Controller
{
  public $db;

  function  __construct() {
    $host     = '10.104.1.25';
    $port     = 3306;
    $dbname   = 'challenger';
    $username = 'aiko';
    $password = 'password';
    $this->db = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname, $username, $password);
  }

  function 	view($name, $data = null)
  {
    $v = new View($name);
    $v->render($data);
  }

  function redirect($url) {
    if ($url == '/')
      $url = null;

    $url_redirect = URL.''.$url;

    header("Location: $url_redirect");
    return;
  }
}
