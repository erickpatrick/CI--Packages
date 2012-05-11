<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Results_model extends LOTO_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table_name = 'sorted';
    $this->table_id   = 'id';
  }

  // Overides $this->fetch_all() from core/LOTO_Model
  public function fetch_all($limit = NULL, $offset = 0)
  {
    return $this->db->order_by('id', 'DESC')->get($this->table_name, $limit, $offset)->result();
  }

  // Counts how many times each sum (the sum from the sorted numbers)
  //  has been "choosen"
  public function group_sum()
  {
    return $this->db->select('count(sum) as "quantity", sum')->order_by('count(sum)', 'DESC')->group_by('sum')->get($this->table_name)->result(); 
  }

  // Fetchs the last game in database and preapre it in better Object
  public function get_last_game_data()
  {
    $lg   = $this->fetch('last');
    $base = range(1, 25);

    // Standart Object
    $game       = new stdClass;
    $game->id   = $lg[0]->id;
    $game->date = $lg[0]->date;
    $game->sum  = $lg[0]->sum;

    unset($lg[0]->id, $lg[0]->date, $lg[0]->sum);

    $game->numbers = array();
    foreach ($lg[0] as $n) :
      $game->numbers[] = $n;
    endforeach;

    sort($game->numbers);
    $game->left    = array_diff($base, $game->numbers);

    $game->numbers = implode(', ', $game->numbers);
    $game->left    = implode(', ', $game->left);

    return $game;
  }
}
