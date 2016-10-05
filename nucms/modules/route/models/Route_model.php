<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Route_model
 */
class Route_model extends MY_Model
{
    public $table = 'nu_route';
    public $primary_key = 'id';
    public $rules = [
        'insert' => [
            'slug' => ['field' => 'slug', 'label' => 'lang:form.slug', 'rules' => 'required|trim|xss_clean|min_length[3]'],
        ],
        'update' => [
            'slug' => ['field' => 'slug', 'label' => 'lang:form.slug', 'rules' => 'required|trim|xss_clean|min_length[3]'],
        ],
    ];


    function __construct()
    {
        $this->timestamps = false;

        parent::__construct();
    }

    /**
     * Prepare unique slug
     *
     * @param string $slug
     * @param string $url
     * 
     * @return string
     */
    public function prepare_unique_slug($slug, $id = null)
    {
        $slugOk = mb_strtolower(prepareURL($slug), 'utf-8');
        $slugTmp = $slugOk;
        $where = [
            'slug' => $slugTmp,
        ];
        if ($id !== null) {
            $where['id !='] = (int) $id;
        }
        
        $i = 0;
        while ($route = $this->where($where)->count_rows()) {
            $i++;
            $where['slug'] = $slugOk . '-' . $i;
        }

        if ($i > 0) {
            $slugOk .= '-' . $i;
        }

        return $slugOk;
    }
}

/* End of file Route_model.php */
/* Location: ./application/modules/route/models/Route_model.php */