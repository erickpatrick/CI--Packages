<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Make extends LOTO_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('make_model', 'make');
  }

  // Simple fulfill the database with this pre set
  public function index()
  {
    if ($this->make->up('assets/excel-csv/lotofacil-725.csv')) :
      // It run smoothly
      $data = array('flag' => TRUE, 'kind' => 'success', 'msg' => 'Banco de dados preenchido com sucesso');
    else :
      // Oh-oh error
      $data = array('flag' => FALSE, 'kind' => 'error', 'msg' => 'Problemas ao preencher banco de dados usando arquivo base');
    endif;

    $this->session->set_flashdata($data);
    redirect('home/index');
  }
}