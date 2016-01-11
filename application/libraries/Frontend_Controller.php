<?php

class Backend_Controller extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        // Set the admin template
        $this->output->set_template(config_item('theme'));
    }
}

/* End of file Backend_controller.php */
/* Location: ./application/libraries/Backend_controller.php */