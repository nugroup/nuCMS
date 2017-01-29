<?php

/**
 * Library to generate sitemap
 *
 * @author nugato
 */
class Sitemap_nu
{
    /**
     * Codeigniter instance
     *
     * @var Controller
     */
    private $CI;

    /**
     * @var XmlWriter
     */
    private $xml;
    
    /**
     * Path to index sitemap
     * 
     * @var string
     */
    private $indexPath = 'sitemap.xml';

    /**
     * Sitemap folder path
     * 
     * @var string
     */
    private $path = 'sitemaps/';

    /**
     * @var string
     */
    private $changefreq = 'monthly';

    /**
     * @var int
     */
    private $priority = 1;

    /**
     * @var array
     */
    private $languages;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->xml = new XMLWriter();

        $this->CI->load->model('route/route_model', 'route');
        $this->CI->load->library('block/block_lib');
        $this->languages = $this->CI->config->item('system_languages');

        if (!file_exists(FCPATH . $this->path)) {
            mkdir(FCPATH . $this->path, 0777);
        }
    }

    /**
     * Generate full structure of sitemaps
     * 
     * @param array $additionalUrls
     */
    public function generate()
    {
        $this->generateIndex();

        foreach ($this->languages as $lang) {
            $pages = $this->getPages($lang->locale);
            $newsCategories = $this->getNewsCategories($lang->locale);
            $news = $this->getNews($lang->locale);

            $urls = array_merge($pages, $newsCategories, $news);

            $this->generateForLocale($urls, $lang->locale);
        }
    }

    /**
     * Generate index sitemap
     */
    private function generateIndex()
    {
        $dt = new Datetime();

        $this->xml->openURI($this->indexPath);
        $this->xml->setIndent(true);
        $this->xml->startDocument('1.0', 'utf-8');
        $this->xml->startElement('sitemapindex');
        $this->xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->languages as $lang) {
            $urlTmp = site_url($this->path . 'sitemap_' . $lang->locale . '.xml');
            $this->xml->startElement('sitemap');
            $this->xml->writeElement('loc', $urlTmp);
            $this->xml->writeElement('lastmod', $dt->format('Y-m-d'));
            $this->xml->endElement();
        }

        $this->xml->endElement();
        $this->xml->endDocument();
        $this->xml->flush();
    }

    /**
     * Generate sitemap for specific locale
     * 
     * @param array $urls
     * @param string $locale
     */
    private function generateForLocale(array $urls, $locale)
    {
        $dt = new Datetime();

        $this->xml->openURI($this->path . 'sitemap_' . $locale . '.xml');
        $this->xml->setIndent(true);
        $this->xml->startDocument('1.0', 'utf-8');
        $this->xml->startElement('urlset');
        $this->xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->xml->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

        foreach ($urls as $url) {
            $this->xml->startElement('url');
            $this->xml->writeElement('loc', $url['loc']);
            $this->xml->writeElement('lastmod', $dt->format('Y-m-d'));
            $this->xml->writeElement('changefreq', $this->changefreq);
            $this->xml->writeElement('priority', $this->priority);

            if (isset($url['images'])) {
                foreach ($url['images'] as $img) {
                    $this->xml->startElement('image');
                    $this->xml->writeElement('image:loc', $img['loc']);
                    $this->xml->writeElement('image:caption', strip_tags($img['caption']));
                    $this->xml->writeElement('image:title', strip_tags($img['title']));
                    $this->xml->endElement();
                }
            }

            $this->xml->endElement();
        }

        $this->xml->endElement();
        $this->xml->endDocument();
        $this->xml->flush();
    }

    /**
     * Get pages for sitemaps
     * 
     * @param string $locale
     * 
     * @return array
     */
    private function getPages($locale)
    {
        $this->CI->load->model('page/page_translations_model', 'page_translations');

        $urls = [];

        $pages = $this->CI->page_translations
            ->fields('id, title, content')
            ->with_route()
            ->where('locale', $locale)
            ->where('active', 1)
            ->get_all();

        if ($pages) {
            foreach ($pages as $page) {
                $url = [];
                $url['loc'] = site_url($page->route->slug);

                if (is_array($page->content_blocks) && !empty($page->content_blocks)) {
                    $imagesTmp = $this->CI->block_lib->getImagesFromContent($page->content_blocks);
                    if (!empty($imagesTmp)) {
                        foreach ($imagesTmp as $img) {
                            $url['images'][] = [
                                'loc' => $img['filepath'],
                                'caption' => $img['alt'],
                                'title' => $img['title'],
                            ];
                        }
                    }
                }

                $urls[] = $url;
                unset($url);
            }
        }

        return $urls;
    }

    /**
     * Get news categories for sitemaps
     * 
     * @param string $locale
     * 
     * @return array
     */
    private function getNewsCategories($locale)
    {
        $this->CI->load->model('news/news_category_translations_model', 'news_category_translations');

        $urls = [];

        $categories = $this->CI->news_category_translations
            ->fields('id, name')
            ->with_route()
            ->where('locale', $locale)
            ->where('active', 1)
            ->get_all();

        if ($categories) {
            foreach ($categories as $category) {
                $prefix = $this->CI->config->item('news_category', 'prefix');
                $urls[] = ['loc' => site_url($prefix . $category->route->slug)];
            }
        }

        return $urls;
    }

    /**
     * Get news for sitemaps
     * 
     * @param string $locale
     * 
     * @return array
     */
    private function getNews($locale)
    {
        $this->CI->load->model('news/news_translations_model', 'news_translations');

        $urls = [];

        $newsList = $this->CI->news_translations
            ->fields('id, title, content')
            ->with_route()
            ->where('locale', $locale)
            ->where('active', 1)
            ->get_all();

        if ($newsList) {
            foreach ($newsList as $news) {
                $url = [];
                $prefix = $this->CI->config->item('news', 'prefix');
                $url['loc'] = site_url($prefix . $news->route->slug);

                if (is_array($news->content_blocks) && !empty($news->content_blocks)) {
                    $imagesTmp = $this->CI->block_lib->getImagesFromContent($news->content_blocks);
                    if (!empty($imagesTmp)) {
                        foreach ($imagesTmp as $img) {
                            $url['images'][] = [
                                'loc' => $img['filepath'],
                                'caption' => $img['alt'],
                                'title' => $img['title'],
                            ];
                        }
                    }
                }

                $urls[] = $url;
                unset($url);
            }
        }


        return $urls;
    }
}

/* End of file Sitemap_nu.php */
/* Location: ./nucms/libraries/Sitemap_nu.php */