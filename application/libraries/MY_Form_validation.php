<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    public $CI;

    /**
     * Function to check uniq login (use by form validations)
     * 
     * @param string $str
     * @param array $params
     * @return boolean
     */
    public function my_unique_field($str, $params)
    {
        $params_split = preg_split('/,/', $params);

        if (isset($params_split[0]) && isset($params_split[1]) && isset($params_split[2])) {
            $table = $params_split[0];
            $field = $params_split[1];
            $primary_key = $params_split[2];
            $id = isset($params_split[3]) ? $params_split[3] : NULL;

            $this->CI->db->where($field, $str);
            if ($id != NULL) {
                $this->CI->db->where($primary_key.' !=', $id);
            }

            $elements = $this->CI->db->get($table)->num_rows();
            if ($elements > 0) {
                $this->CI->form_validation->set_message('my_unique_field', lang('field').' '.$field.' '.lang('form_validation_my_unique_field'));
                return FALSE;
            }
        }

        return TRUE;
    }
}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */