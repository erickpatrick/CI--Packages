<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LOTO_Model extends CI_Model {
  protected $table_name;
  protected $table_id;

  // Simple "ORM"
  public function __construct()
  {
    parent::__construct();
  }

  public function find($id)
  {
    return $this->db->where($this->table_id, $id)->get($this->table_name)->result();
  }

  public function find_by($conditions)
  {
    return $this->db->get_where($this->table_name, $conditions)->result();
  }

  public function fetch($sequence = 'first')
  {
    $sequence = ($sequence == 'first') ? 'ASC' : 'DESC';
    return $this->db->order_by('id', $sequence)->get($this->table_name, 1, 0)->result();
  }

  public function fetch_all($limit = NULL, $offset = 0)
  {
    return $this->db->get($this->table_name, $limit, $offset)->result();
  }

  public function insert($data)
  {
    $this->db->insert($this->table_name, $data);
    return $this->db->insert_id();
  }

  public function insert_batch($data)
  {
    $this->db->insert_batch($this->table_name, $data);
    return $this->db->affected_rows();
  }

  public function update($data, $conditions)
  {
    $this->db->update($this->table_name, $data, $conditions);
    return $this->db->affected_rows();
  }

  public function delete($conditions)
  {
    $this->db->delete($this->table_name, $conditions);
    return $this->db->affected_rows();
  }

  public function join($conditions, $limit = TRUE)
  {
    $this->db->from($this->table_name);

    // JOIN as many tables as in $conditions
    foreach ($conditions['tables'] as $tbl) :
      $this->db->select($tbl['select']);
      $this->db->join($tbl['name'], "{$tbl['name']}.{$tbl['on_field']} = {$this->table_name}.{$tbl['on_field']}");
    endforeach;

    // Filter query results using LIKE, as it's less restritive then WHERE
    if (array_key_exists('where', $conditions)) :
      foreach($conditions['where'] as $cond => $value) :
        $this->db->like($cond, urldecode($value));
      endforeach;
    endif;

    // If $limit is set to FALSE returns all results
    if ($limit) :
      $this->db->limit(10);
      $this->db->offset($conditions['offset']);
    endif;

    // Debug
    //echo $this->db->last_query();
    return $this->db->get()->result();
  }
}