<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Make_model extends LOTO_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table_name = 'sorted';
    $this->table_id   = 'id';
  }

  // Open CSV files to fulfill table
  public function up($path_to_file)
  {
    $this->load->helper('file');
    $file = read_file($path_to_file);
    $file = explode("\r", $file);

    $count = count($file);
    for ($i = 0; $i < $count; $i += 1) :
      list($id, $date, $b1, $b2, $b3, $b4, $b5, $b6, $b7, $b8, $b9, $b10, $b11, $b12, $b13, $b14, $b15) = explode(";", $file[$i]);

      $date = explode('/', $date);
      $date = $date[2] . '-' . $date[1] . '-' . $date[0];

      $this->insert(array(
        'id'   => $id,
        'date' => $date,
        'b1'   => $b1,
        'b2'   => $b2,
        'b3'   => $b3,
        'b4'   => $b4,
        'b5'   => $b5,
        'b6'   => $b6,
        'b7'   => $b7,
        'b8'   => $b8,
        'b9'   => $b9,
        'b10'  => $b10,
        'b11'  => $b11,
        'b12'  => $b12,
        'b13'  => $b13,
        'b14'  => $b14,
        'b15'  => $b15,
        'sum'  => $b1 + $b2 + $b3 + $b4 + $b5 + $b6 + $b7 + $b8 + $b9 + $b10 + $b11 + $b12 + $b13 + $b14 + $b15
      ));
    endfor;

    return TRUE;
  }
}