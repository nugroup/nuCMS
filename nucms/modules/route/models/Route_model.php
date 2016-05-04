<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Route_model
 */
class Route_model extends MY_Model
{
    public $table = 'nu_route';
    public $primary_key = 'primary_key';
    public $after_create = ['save_routes'];
    public $after_update = ['save_routes'];
    public $after_delete = ['save_routes'];

    function __construct()
    {
        $this->timestamps = false;

        parent::__construct();
    }

    /**
     * Generate file with dynamic routes
     *
     * @return void
     */
    public function save_routes($result = 0)
    {
        $this->load->helper('file');
        $fileName = APPPATH.'cache/dynamic_routes.php';
        $routes = $this->get_all();

        if ($routes) {
            $data[] = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');";

            foreach ($routes as $route) {
                $data[] = '$route["'.$route->slug.'"] = "'.$route->slug.'";';
            }

            $output = implode("\n", $data);
            write_file($fileName, $output);
            @chmod($fileName, 0777);
        } else {
            write_file($fileName, '');
            @chmod($fileName, 0777);
        }

        return $result;
    }

    /**
     * Prepare unique slug
     *
     * @param string $slug
     * @param string $url
     * @return string
     */
    public function prepare_unique_slug($slug, $url = '')
    {
        $slugOk = mb_strtolower(prepareURL($slug), 'utf-8');
        $slugTmp = $slugOk;

        $i = 0;
        while ($route = $this->where(['slug' => $slugTmp, 'url !=' => $url])->count_rows()) {
            $i++;
            $slugTmp = $slugOk.'-'.$i;
        }

        if ($i > 0) {
            $slugOk .= '-'.$i;
        }

        return $slugOk;
    }
}

/* End of file Route_model.php */
/* Location: ./application/modules/route/models/Route_model.php */