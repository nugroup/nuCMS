<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Setting_translations_model
 */
class Setting_translations_model extends MY_Model
{
    public $table = 'nu_setting_translations';
    public $primary_key = 'id';
    public $fillable = array();
    public $protected = array();
    public $rules = [
        'update' => [
        ]
    ];

    function __construct()
    {
        // Relationship
        $this->has_one['language'] = array(
            'foreign_model' => 'Language_model',
            'foreign_table' => 'nu_language',
            'foreign_key' => 'locale',
            'local_key' => 'locale'
        );
        $this->has_one['root'] = array(
            'foreign_model' => 'Setting_model',
            'foreign_table' => 'nu_setting',
            'foreign_key' => 'id',
            'local_key' => 'setting_id'
        );

        parent::__construct();
        $this->timestamps = FALSE;
    }

    /**
     * Check exists locale setting and insert if this not exists.
     *
     * @param int $id
     * @param string $locale
     */
    public function check_exists_locale($id, $locale)
    {
        $where = [
            'setting_id' => $id,
            'locale'     => $locale,
        ];
        $locale_setting_exist = $this
            ->where($where)
            ->count_rows();

        // if setting does not exist, insert the new one
        if ($locale_setting_exist == 0) {
            $this->setting_translations->insert($where);
        }
    }
}

/* End of file Setting_translations_model.php */
/* Location: ./application/modules/setting/models/Setting_translations_model.php */