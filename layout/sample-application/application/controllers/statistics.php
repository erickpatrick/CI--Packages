<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Statistics extends LOTO_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('statistics_model', 'statistics');
    $this->load->model('results_model', 'results');
  }

  public function index()
  {
    $data = array(
      'msg'     => $this->uri->segment(3),
      'stats'   => $this->statistics->group_sum(68),
      'total'   => $this->statistics->total(),
      'vals'    => $this->statistics->simple_mean_group_sum(),
      'game'    => $this->results->get_last_game_data(),
      'means'   => $this->statistics->get_means(),
      'max_min' => $this->statistics->count_base_numbers()
    );

    $this->body('statistics/index', $data);
    $this->render('partials/index');
  }
}