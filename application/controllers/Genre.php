<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/17/15
 * Time: 8:37 PM
 */
class Genre extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('genre');
    }


    public function ajax()
    {
        $result =  $this->genre->search();
        echo json_encode($result);
    }
}