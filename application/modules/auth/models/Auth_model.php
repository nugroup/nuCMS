<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Model extends MY_Model 
{
    public $table = 'nu_user';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Login
     */
    public function login()
    {
        $where = array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password'))
        );
        $user = $this->where($where)->get();
        if($user)
        {
            // log in
            $data = array();
            $data['admin_user'] = array(
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'logged' => TRUE
            );
            $this->session->set_userdata($data);
            return TRUE;
        }

        unset($user);
        $where = array(
            'login' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password'))
        );
        $user = $this->where($where)->get();
        if($user)
        {
            // log in
            $data = array();
            $data['admin_user'] = array(
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'logged' => TRUE
            );
            $this->session->set_userdata($data);
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
    }

    /**
     * Check if is logged in
     * 
     * @return boolean
     */
    public function logged_in()
    {
        if(isset($this->session->userdata['admin_user']['logged']))
        {
            return (bool) $this->session->userdata['admin_user']['logged'];
        }
    }

    /**
     * Hash password hasła sha512 with salt
     * 
     * @param string $string
     * @return string
     */
    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}

/* End of file Auth_Model.php */
/* Location: ./application/modules/cms/auth/models/Auth_Model.php */