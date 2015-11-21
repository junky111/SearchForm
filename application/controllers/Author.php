<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/17/15
 * Time: 8:37 PM
 */
class Author extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('author');
    }


    public function ajax()
    {
        $result =  $this->author->search($this->input->post('conditions'));
        echo json_encode($result);
    }
}