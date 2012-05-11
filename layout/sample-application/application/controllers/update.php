<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Update extends LOTO_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('results_model', 'results');
  }

  public function index()
  {
    $data = array();

    // Fills the body part of the template
    $this->body('update/add', $data);

    // The template which we are going to fulfill
    $this->render('partials/index');
  }

  // Save data to database
  public function save()
  {
    $post        = $this->input->post();
    $post['sum'] = 0;

    // Sum up the sorted numbers
    for ($i = 1; $i < 16; $i += 1) :
      $post['sum'] += $post['b' . $i];
    endfor;

    if (! $this->results->find_by($post)) :
      if ($this->results->insert($post)) :
        // Runs smoothtly
        $data = array('flag' => TRUE, 'kind' => 'success', 'msg' => 'Atualização realizada com successo');
      else :
        // Houston, we got a problem!
        $data = array('flag' => TRUE, 'kind' => 'error', 'msg' => 'Problema ao realizar atualização. Verificar banco de dados');
      endif;
    else :
      // Well, doubled work…
      $data = array('flag' => TRUE, 'kind' => 'warning', 'msg' => '<strong>Sorteio já inserido</strong>');
      $this->session->set_flashdata($data);
      redirect('update/index');
    endif;

    $this->session->set_flashdata($data);
    redirect('home/index');
  }
}