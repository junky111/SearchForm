<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/15
 * Time: 6:39 PM
 */
class MY_Controller extends CI_Controller
{
    private $layoutDef = 'Layout';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('assets');
        $this->load->helper('form');
        $this->load->library($this->getLayout());
    }
    public function getLayout()
    {
        return $this->layoutDef;
    }
    public function setLayout($layoutDef)
    {
        $this->layoutDef=$layoutDef;
    }

}