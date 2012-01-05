<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multiple_upload {
  private $CI;
  private $config;

  private $data;
  private $errors;

  public function __construct()
  {
    $this->CI = &get_instance();
    $this->CI->config->load('multiple_upload_settings');
    $this->initialize();
  }

  public function initialize($kind = 'basic')
  {
    $this->config = $this->CI->config->item($kind);
  }

  public function errors()
  {
    return $this->errors;
  }

  public function data()
  {
    return $this->data;
  }

  public function do_multiple_upload($field = 'userfile')
  {
    $this->CI->load->library('upload');

    $upl_files                = $_FILES[$field];
    $number_of_files_uploaded = count($upl_files['name']);

    // Faking upload calls to $_FILE
    for ($i = 0; $i < $number_of_files_uploaded; $i++) :
      $_FILES['userfile']['name']     =     $upl_files['name'][$i];
      $_FILES['userfile']['type']     =     $upl_files['type'][$i];
      $_FILES['userfile']['tmp_name'] = $upl_files['tmp_name'][$i];
      $_FILES['userfile']['error']    =    $upl_files['error'][$i];
      $_FILES['userfile']['size']     =     $upl_files['size'][$i];

      $config = array(
        'file_name'     =>  $this->generate_random_name(23),
        'allowed_types' =>   $this->config['allowed_types'],
        'max_size'      =>  $this->config['max_files_size'],
        'overwrite'     => $this->config['overwrite_files'],
        
        /* real path to upload folder ALWAYS */
        'upload_path'   => $this->config['upload_path']
      );

      $this->CI->upload->initialize($config);

      if ( ! $this->CI->upload->do_upload()) :
        $this->errors[] = $this->CI->upload->display_errors();
      else :
        $this->data[] = $this->CI->upload->data();
      endif;
    endfor;

    return $this->data;
  }

  public function generate_random_name($name_length)
  {
    if ($name_length <= 0) :
      return false;
    endif; 

    $code = "";
    $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789_";
    srand((double)microtime() * 1000000);

    for ($i = 0; $i < $name_length; $i++) :
      $code = $code . substr($chars, rand() % strlen($chars), 1);
    endfor;
    
    return $code;
  }
}