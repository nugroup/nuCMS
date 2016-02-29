<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Menu_widget
 */
class Menu_widget
{
    private $CI;

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->config->load('menu/menu', true);
        $this->CI->load->model('menu/menu_model', 'menu');
        $this->CI->load->model('menu/menu_items_model', 'menu_items');
        $this->CI->config->load('multi_menu', true);
    }

    /**
     * Display menu by position
     *
     * @param int $position
     * @param array $config - config array (default in config/multi_menu.php)
     */
    public function display($position, $config = array())
    {
        $menuItems = false;

        // Get menu by position
        $menu = $this->CI->menu->get(['position' => $position]);

        if ($menu) {
            $where = [
                'menu_id' => $menu->id,
                'nu_menu_items.locale'  => config_item('selected_locale')
            ];

            $menuItems = $this->CI->menu_items->get_with_routes($where);
            if ($menuItems) {
                $i = 0;
                foreach ($menuItems as $item) {
                    if ($item['route_slug'] != '') {
                        $menuItems[$i]['slug'] = $item['route_slug'];
                    }
                    $i++;
                }
            }
        }

        if ($menuItems) {
            $this->CI->load->library('multi_menu');

            // Set end display menu
            $this->CI->multi_menu->set_items($menuItems);
            echo $this->CI->multi_menu->render($config);
        }
    }
}