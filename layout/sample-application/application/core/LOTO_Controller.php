<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LOTO_Controller extends CI_Controller
{
  public static $conn;

  public function __construct()
  {
    parent::__construct();

    // Preload header and footer
    $this->header('partials/header',   null);
    $this->footer('partials/footer',   null);
  }

  // Magic method allows to create region methods to layout library
  public function __call($name, $arguments)
  {
    $this->layout->region($name, $arguments[0], $arguments[1]);
  }

  public function render($tpl_name)
  {
    $this->layout->show($tpl_name);
  }
}