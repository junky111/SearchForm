<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/15
 * Time: 3:52 PM
 */
class Layout
{
    private $header = 'header';
    private $footer = 'footer';
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    public function content ($views = '' , $data = '')
    {
        if ($this->getHeader()) {
            $this->CI->load->view($this->getHeader());
        }
        if (is_array($views))
        {
            foreach ($views as $view)
            {
                $this->CI->load->view($view, $data);
            }
        }else
        {
            $this->CI->load->view($views, $data);
        }
        if($this->getFooter())
        {
            $this->CI->load->view($this->getFooter());
        }
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }
    public function getFooter()
    {
        return $this->footer;
    }
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }
}