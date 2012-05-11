<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends LOTO_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('results_model', 'results');
  }

  public function index()
  {
    // The data which this method will need
    $data = array(
      'msg'     => $this->uri->segment(3),
      'results' => $this->results->fetch_all(52)
    );

    // Fills one of the parts in the template.
    // The other parts are: Header and Footer, which are fulfilled
    //  within core/LOTO_Controller.php.
    // If any of the Header or Footer change in this controller,
    //  simply call $this->header('path_to_partial', $data_to_partial)
    $this->body('home/index', $data);

    // Which template we are going to use
    $this->render('partials/index');
  }
}