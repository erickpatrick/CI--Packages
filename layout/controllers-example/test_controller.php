<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
  class Test_controller extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
      $header =
        array('title' => 'teste',
              'style' => array('teste')
            );

      $this->layout->region('header', 'header', $header);
      $this->layout->region('content', 'content');
      $this->layout->region('footer', 'footer');
      $this->layout->show('example-layout');
    }

  }