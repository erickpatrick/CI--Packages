<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {

  private $ci = NULL;
  private $layout;

  // Get's CI instance to use inside Library
  public function __construct()
  {
    $this->ci = & get_instance();
    $this->layout = NULL;
  }

  // Load and parse some view. Acts just like $this->load->view(), but it doesn't need the third parameter, it'll be
  // useful to load something from a Model and save into a variable and then send to a Region as its content
  public function sub($path, $data)
  {
    return $this->ci->load->view($path, $data, TRUE);
  }

  // It'll populate a layout's region from one of yours full layout ("example-layout"), where you instantiate and
  // place at yout VIEWS folder
  public function region($name, $path, $data = NULL)
  {
    $this->layout[$name] = $this->ci->load->view($path, $data, TRUE);
  }

  // Prints out the complete rendered layout to the user
  public function show($tpl_name)
  {
    $this->ci->load->view($tpl_name, $this->layout);
  }

}