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

    /**
     * Save checked news category
     * 
     * @param array $categories
     * @param int $newsId
     */
    public function save_news_categories($categories, $newsId)
    {
        $this->delete(['news_id' => $newsId]);

        foreach ($categories as $category) {
            $insertData[] = [
                'news_id' => $newsId,
                'news_category_id' => $category
            ];
        }

        $this->db->insert_batch($this->table, $insertData);
    }

    /**
     * Get array with news selected categories id
     * 
     * @param int $newsId
     * 
     * @return array
     */
    public function get_selected_categories($newsId)
    {
        $selectedNewsCategory = $this
            ->where('news_id', $newsId)
            ->as_array()
            ->get_all();

        if ($selectedNewsCategory) {
            return array_column($selectedNewsCategory, 'news_category_id');
        }

        return [];
    }
}

/* End of file News_category_news_model.php */
/* Location: ./nucms/modules/news/models/News_category_news_model.php */