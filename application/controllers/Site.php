<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/15
 * Time: 3:23 PM
 */
class Site extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dropdown');
        $this->load->model('country');
    }

    public function index()
    {
        $data['name'] = $this->country->getTable();
        $result =  $this->country->search();
        foreach (  $result as $value)
        {
            $data['options'][$value->id]=$value->name;
        }

        $this->layout->content('site/index', $data);
    }
}