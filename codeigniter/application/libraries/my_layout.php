<?php
if (! defined('BASEPATH')) 
    exit('No direct script access allowed');

class My_layout
{

    private $obj = null;
    private $layout = null;

    public function My_layout($layout = "")
    {
        $this->obj =& get_instance();
        $this->layout = $layout;
    }

    public function setLayout($layout)
    {
      $this->layout = $layout;
    }

    public function view($view, $data = null, $return = false)
    {
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);
        if ($return) {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
}