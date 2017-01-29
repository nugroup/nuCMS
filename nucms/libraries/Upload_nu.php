<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Codeigniter Upload helper class
 * 
 * @author nugato
 */
class Upload_nu
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Upload file action
     * You can run this method from other controllers
     * 
     * @return mixed - false - return FALSE; success - return UPLOAD DATA
     */
    public function do_upload($upload_folder)
    {
        // upload config
        $inputName = "file";
        $config['upload_path'] = getcwd().'/'.$upload_folder.'/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '50000';
        $config['file_name'] = $this->prepare_filename($_FILES['file']['name']);

        // Load upload library
        $this->CI->load->library('upload', $config);

        // Upload file
        if ($this->CI->upload->do_upload($inputName)) {
            $upload_data = $this->CI->upload->data();
            chmod($upload_data['full_path'], 0777);

            return $upload_data;
        }

        return FALSE;
    }

    /**
     * Preapre safe filename
     *
     * @param string $filename
     * @return string
     */
    public function prepare_filename($filename)
    {
        $this->CI->load->helper('text');

        $fileExt = extension($filename);
        $filenameNoExt = str_replace('.'.$fileExt, '', $_FILES['file']['name']);

        return url_title(convert_accented_characters($filenameNoExt), '-', true).'.'.$fileExt;
    }
}

/* End of file Upload_nu.php */
/* Location: ./nucms/libraries/Upload_nu.php */