<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Block_model
 */
class Block_model extends MY_Model
{
    public $table = 'nu_block';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
        parent::__construct();

        $this->timestamps = true;
    }

    /**
     * Get validations rules
     *
     * @param string $action
     * @return array
     */
    public function get_rules($action = '', $id = 0)
    {
        $rules = array();

        if ($action == 'add') {
            $rules['name'] = array('field' => 'name', 'label' => lang('block.form.name'), 'rules' => 'required|trim|xss_clean');
        } else {

        }

        return $rules;
    }
    
    /**
     * Generate query from search string
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('name', $string);
            $this->db->where('locale', $this->input->get('locale'));
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }
}

/* End of file Block_model.php */
/* Location: ./application/modules/block/models/Block_model.php */