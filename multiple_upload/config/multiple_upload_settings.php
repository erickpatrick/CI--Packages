<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * The second parte is the where your application folder is
 */
define('BP', $_SERVER['DOCUMENT_ROOT'] . '/Local/loterias/');

/*
 * Change the path to the folder where the images are going to be saved.
 * The path is relative to the ROOT folder of your host. 
 */
$config['basic']['orig_folder']     =    BP . 'images/gallery/originals/';

/*
 * Necessary info to upload files. You'll change this, when needed, to allow
 * your application upload different files. Though not good, you're allowed to
 * use the wildcard '*'
 */
$config['basic']['allowed_types']   =                  'jpg|png|gif|jpeg';
$config['basic']['max_files_size']  =                                3000;
$config['basic']['overwrite_files'] =                                TRUE;
$config['basic']['upload_path']     =     $config['basic']['orig_folder'];