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

    /**
     * Get the number of list by category
     * 
     * @param int $newsCategoryId
     * 
     * @return int
     */
    public function get_number_of_news_list_by_category($newsCategoryId, $locale)
    {
        $dt = new DateTime();

        return $this->db
            ->from($this->table)
            ->join('nu_news_translations AS n', 'nu_news_category_news.news_id = n.news_id')
            ->where('n.locale', $locale)
            ->where('news_category_id', $newsCategoryId)
            ->where('active', 1)
            ->where('publication_date >=', $dt->format('Y-m-d'))
            ->count_all_results();
    }

    /**
     * Get the news list by category
     * 
     * @param int $newsCategoryId
     * @param string $locale
     * @param int $limit
     * @param int $offset
     * 
     * @return array
     */
    public function get_news_list_by_category(
        $newsCategoryId,
        $locale,
        $limit = null,
        $offset = null
    ) {
        $dt = new DateTime();

        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
        }

        $prefix = $this->config->item('news', 'prefix');
        $news = $this->db
            ->select('n.*, f.filename AS file_filename, f.alt AS file_alt, f.title AS file_title, CONCAT("' . $prefix . '", r.slug) AS slug')
            ->from($this->table . ' AS ncn')
            ->join('nu_news_translations AS n', 'ncn.news_id = n.news_id')
            ->join('nu_file AS f', 'n.file_id = f.id', 'left')
            ->join('nu_route AS r', 'r.primary_key = n.news_id AND r.module = "news" AND n.locale = r.locale', 'left')
            ->where('n.locale', $locale)
            ->where('ncn.news_category_id', $newsCategoryId)
            ->where('n.active', 1)
            ->where('DATE_FORMAT(n.publication_date, "%Y-%m-%d") <=', $dt->format('Y-m-d'))
            ->get()
            ->result();

        return ($news) ?: [];
    }
}

/* End of file News_category_news_model.php */
/* Location: ./nucms/modules/news/models/News_category_news_model.php */