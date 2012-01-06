<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multiple_upload {
  private $CI;
  private $_config;
  private $_data;
  private $_errors;

  /*
   * Initialize the multiple upload with the *basic* configuration
   */
  public function __construct()
  {
    $this->CI = &get_instance();
    $this->CI->config->load('multiple_upload_settings');
    $this->initialize();
  }

  /*
   * When needed and if there is other config beyond *basic*, it's allowed
   * call it by passing the config's name as the function parameter
   */
  public function initialize($kind = 'basic')
  {
    $this->_config = $this->CI->config->item($kind);
  }

  /*
   * Returns all errors in the upload
   */
  public function errors()
  {
    return $this->_errors;
  }

  /*
   * Returns all data about the files after they were uploaded
   */
  public function data()
  {
    return $this->_data;
  }

  /*
   * The multiple upload method. It can be used to upload single files as
   * well as multiple files at once
   */
  public function do_multiple_upload($field = 'userfile')
  {
    $this->CI->load->library('upload');

    $upl_files                = $_FILES[$field];
    $number_of_files_uploaded = count($upl_files['name']);

    // Though can be sent plenty of files, we fake as they were sent
    // one-by-one, hacking the global $_FILES, to work with the CI's
    // built-in Upload Library
    for ($i = 0; $i < $number_of_files_uploaded; $i++) :
      $_FILES['userfile']['name']     =     $upl_files['name'][$i];
      $_FILES['userfile']['type']     =     $upl_files['type'][$i];
      $_FILES['userfile']['tmp_name'] = $upl_files['tmp_name'][$i];
      $_FILES['userfile']['error']    =    $upl_files['error'][$i];
      $_FILES['userfile']['size']     =     $upl_files['size'][$i];

      $config = array(
        'file_name'     =>  $this->_generate_random_name(23),
        'allowed_types' =>   $this->_config['allowed_types'],
        'max_size'      =>  $this->_config['max_files_size'],
        'overwrite'     => $this->_config['overwrite_files'],
        
        /* real path to upload folder ALWAYS */
        'upload_path'   => $this->_config['upload_path']
      );

      $this->CI->upload->initialize($config);

      if ( ! $this->CI->upload->do_upload()) :
        $this->_errors[] = $this->CI->upload->display_errors();
      else :
        $this->_data[] = $this->CI->upload->data();
      endif;
    endfor;

    return $this->data();
  }

  /*
   * Generate a random name to the uploaded files with 23 chars. This is enough
   * to guarantee no colisions will happen too soon.
   */
  private function _generate_random_name($name_length = 10)
  {
    // If someone tries to lure the function
    if ($name_length <= 0) :
      return false;
    endif; 

    $random_name = "";

    // All valid chars to be used in generation
    $valid_chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789_";

    srand((double)microtime() * 1000000);
    for ($i = 0; $i < $name_length; $i++) :
      $random_name = $random_name . substr($valid_chars, rand() % strlen($valid_chars), 1);
    endfor;
    
    return $random_name;
  }
}