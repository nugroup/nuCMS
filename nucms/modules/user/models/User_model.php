<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class User_model
 */
class User_model extends MY_Model
{
    public $table = 'nu_user';
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

        $rules['name'] = array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|xss_clean');

        if ($action == 'insert') {
            $rules['email'] = array('field' => 'email', 'label' => lang('user.form.email'), 'rules' => 'my_unique_field['.$this->table.',email,id]|trim|required|valid_email|xss_clean');
            $rules['password'] = array('field' => 'password', 'label' => lang('user.form.password'), 'rules' => 'required|xss_clean');
            $rules['password_repeat'] = array('field' => 'password_repeat', 'label' => lang('user.form.password_repeat'), 'rules' => 'required|matches[password]|xss_clean');
        } else {
            $rules['email'] = array('field' => 'email', 'label' => lang('user.form.email'), 'rules' => 'my_unique_field['.$this->table.',email,id,'.$id.']|trim|required|valid_email|xss_clean');
            $rules['password'] = array('field' => 'password', 'label' => lang('user.form.password'), 'rules' => 'xss_clean');
            $rules['password_repeat'] = array('field' => 'password_repeat', 'label' => lang('user.form.password_repeat'), 'rules' => 'matches[password]|xss_clean');
        }

        return $rules;
    }

    /**
     * Prepare like and order_by query from $_GET
     *
     * @param string $string
     */
    public function generate_like_query($string)
    {
        if ($string) {
            $this->db->like('first_name', $string);
            $this->db->or_like('last_name', $string);
            $this->db->or_like('username', $string);
            $this->db->or_like('email', $string);
        }

        if ($this->input->get('sort') && $this->input->get('sort_type')) {
            $this->db->order_by($this->input->get('sort'), $this->input->get('sort_type'));
        }
    }
}

/* End of file Users_model.php */
/* Location: ./application/modules/users/models/Users_model.php */