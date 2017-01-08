<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class News_category_news_model
 */
class News_category_news_model extends MY_Model
{
    public $table = 'nu_news_category_news';
    public $primary_key = 'news_id';

    function __construct()
    {
        parent::__construct();
        $this->timestamps = false;
    }
}

/* End of file News_category_news_model.php */
/* Location: ./nucms/modules/news/models/News_category_news_model.php */