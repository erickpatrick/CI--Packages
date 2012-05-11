<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Statistics_model extends LOTO_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table_id   = 'id';

    $this->load->model('results_model', 'results');
  }

  // Same as Results\group_sum() but added the $limit option
  public function group_sum($limit = FALSE)
  {
    if ($limit) :
      $this->db->limit($limit);
    endif;

    return $this->db->select('count(sum) as "quantity", sum')->order_by('quantity', 'DESC')->group_by('sum')->get('sorted')->result(); 
  }

  public function total()
  {
    return $this->db->count_all('sorted');
  }

  // Generates the simple mean to the grouped sums
  public function simple_mean_group_sum()
  {
    $results = $this->db->select('count(sum) as "quantity", sum')->order_by('sum', 'DESC')->group_by('sum')->get('sorted')->result();

    $values = array('qtt' => 0, 'sum' => 0);
    $count  = count($results);

    foreach ($results as $r) :
      $values['qtt'] += $r->quantity;
      $values['sum'] += $r->sum;
    endforeach;

    $values['qtt'] /= $count;
    $values['sum'] /= $count;

    return $values;
  }

  public function get_means()
  {
    $games   = $this->results->fetch_all(10);
    $results = array();
    $median  = array();
    $mean    = 0;
    $stats   = new stdClass;
    
    // Generate Array with all 25 results and their initial quantities
    for ($i = 1; $i <= 25; $i += 1) :
      $results[$i] = array('num' => $i, 'qtt' => 0);
    endfor;

    // Count the times each of all 25 possible results were sorted
    foreach ($games as $g) :
      $mean += $g->sum;
      unset($g->id, $g->date, $g->sum);
      foreach ($g as $n) :
        $median[]            = $n;
        $results[$n]['qtt'] += 1;
      endforeach;
    endforeach;

    // Order result by the most sorted (qtt field)
    foreach ($results as $key => $row) :
      $num[$key] = $row['num'];
      $qtt[$key] = $row['qtt'];
    endforeach;
    array_multisort($qtt, SORT_DESC, $num, SORT_ASC, $results);

    // Order all values to process the median
    sort($median);

    // The statistics values
    $stats->mode   = $results[0]['num'];
    $stats->mean   = $mean / 10;
    $stats->median = ($median[74] + $median[75]) / 2;

    return $stats;
  }

  public function count_base_numbers()
  {
    $numbers = array();
    $results = array();
    $count   = 1;

    // Some junk hard-coded SQL
    // TODO: Change to Active Record
    $result = $this->db->query("SELECT b1, b2, b3, b4, b5, b6, b7, b8, b9, b10, b11, b12, b13, b14, b15 FROM sorted ORDER BY id DESC LIMIT 10")->result_array();

    // Create an Array "$results" with all values from all games
    // Example: There are 25 games with 15 numbers, each. The final
    //  array is going to have 25 x 15 positions
    foreach ($result as $r) :
      foreach ($r as $v) :
        $results[] = (int) $v;
      endforeach;
    endforeach;

    // Count how many times each values has been sorted
    $results = array_count_values($results);
    arsort($results);

    // Get the top 9 sorted numbers
    // elseif: Get the least 5 sorted numbers
    // else: Get the middle numbers
    foreach ($results as $k => $v) :
      if ($count < 10) :
        $numbers['top'][] = $k;
      elseif ($count > 20) :
        $numbers['bottom'][] = $k;
      else :
        $numbers['middle'][] = $k;
      endif;
      $count += 1;
    endforeach;

    sort($numbers['top']);
    sort($numbers['middle']);
    sort($numbers['bottom']);

    // Just for presentation
    $numbers['top']    = implode(', ', $numbers['top']);
    $numbers['middle'] = implode(', ', $numbers['middle']);
    $numbers['bottom'] = implode(', ', $numbers['bottom']);

    return $numbers;
  }

  // Basic combinatory to all values inside database
  public function combinations($number_of_games)
  {
    $double      = array();
    $triple      = array();
    $combination = $this->results->fetch_all($number_of_games);

    foreach ($combination as $c) :
      // Turn object properties into an associative array
      $c = get_object_vars($c);
      unset($c['id'],$c['date'],$c['sum']);

      for ($i = 1; $i <= 25; $i += 1) :
        if (!in_array($i, $c)) continue;
        // Generate an array combining 2 numbers
        for ($j = $i + 1; $j <= 25; $j += 1) :
          if (!in_array($j, $c)) continue;
          // Generate an array combining 3 numbers
          for ($k = $j + 1; $k <= 25; $k += 1) :
            if (!in_array($k, $c)) continue;
            // Generate an array combining 4 numbers
            for ($l = $k + 1; $l <= 25; $l += 1) :
              $quadruple[] = "{{$i};{$j};{$k};{$l}}";
            endfor;
            $triple[] = "{{$i};{$j};{$k}}";
          endfor;
          $double[] = "{{$i};{$j}}";
        endfor;
      endfor;
    endforeach;

    $c_double   = array_count_values($double);
    $c_triple    = array_count_values($triple);
    $c_quadruple = array_count_values($quadruple);
    arsort($c_double);
    arsort($c_triple);
    arsort($c_quadruple);
    
    // Not finished yet.
    // TODO
    var_dump($c_double, $c_triple, $c_quadruple);
  }
}
