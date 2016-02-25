<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Menu_items_nu
 */
class Menu_items_nu extends Backend_Controller
{
    private $sessionName = 'menu';

    public function __construct()
    {
        parent::__construct();

        // Load classes
        $this->lang->load('menu', config_item('selected_lang'));
        $this->config->load('menu/menu', TRUE);
        $this->load->helper('menu/menu');
        $this->load->model('menu/menu_model', 'menu');
        $this->load->model('page/page_model', 'page');
        $this->load->model('menu/menu_items_model', 'menu_items');
    }

    /**
     * Menu items list - by menu_id
     *
     * @param int $menu_id
     * @return string
     */
    public function lists($menu_id, $localeCode = '')
    {
        $locale = ($localeCode != '') ? $localeCode : config_item('selected_locale');

        $menu_items = $this->menu_items
            ->where(['menu_id' => $menu_id, 'locale' => $locale])
            ->order_by('sort')
            ->get_all();

        $menu_items_parents = $this->menu_items->prepare_parent_array($menu_items);

        // Set view data
        $data['menu_items'] = generate_menu_tree($menu_items_parents, 0, [], 100, 0);

        if ($this->input->is_ajax_request()) {
            $this->render('menu/items/index', $data);
        } else {
            return $this->render('menu/items/index', $data, true);
        }
    }

    /**
     * Add new menu item
     * 
     * @param int $menu_id
     * @return boolean
     */
    public function add($menu_id)
    {
        $locale = ($this->input->get('locale')) ? $this->input->get('locale') : config_item('selected_locale');

        // Clean data
        $insertData = $this->security->xss_clean($this->input->post());
        $insertData['menu_id'] = (int) $menu_id;
        $insertData['locale'] = $locale;

        // Insert
        $inserted_id = $this->menu_items->insert($insertData);
        if ($inserted_id) {
            $result = array('result' => 1);
        } else {
            $result = array('result' => 0);
        }

        header('Content-Type: application/json');
        echo json_encode($result);

        return false;
    }

    /**
     * Edit menu item view (AJAX)
     *
     * @param int $id
     * @return boolean/html
     */
    public function edit($id, $localeCode)
    {
        $locale = ($localeCode) ? $localeCode : config_item('selected_locale');

        $menuItem = $this->menu_items->get($id);
        if (!$menuItem) {
            return false;
        }

        // Get pages list
        $pages = $this->page_translations
            ->where('locale', $locale)
            ->get_all();

        $this->render('menu/items/edit', [
            'menu_item' => $menuItem,
            'pages_options' => obj_to_options_array($pages, 'id', 'title'),
        ]);

        return false;
    }

    /**
     * Save menu item action (AJAX)
     *
     * @param type $id
     * @return boolean
     */
    public function save($id)
    {
        $data = $this->security->xss_clean($this->input->post());

        // Update
        if ($this->menu_items->update($data, $id)) {
            $result = array('result' => 1);
        } else {
            $result = array('result' => 0);
        }

        header('Content-Type: application/json');
        echo json_encode($result);

        return false;
    }

    /**
     * Delete action (by AJAX)
     *
     * @throws Exception
     */
    public function delete()
    {
        if ($this->input->post('id_item')) {
            $id = $this->input->post('id_item');
            if ($id > 0) {
                try {
                    // Delete menu
                    if (!$this->menu_items->delete($id)) {
                        throw new Exception(lang('menu.item.alert.error.delete'));
                    }

                    // Set response data
                    $result['message'] = lang('menu.item.alert.success.delete');
                    $result['status'] = 1;
                } catch (Exception $ex) {
                    // Log error message
                    $this->set_log($ex->getMessage());

                    // Set response data
                    $result['message'] = $ex->getMessage();
                    $result['status'] = 0;
                }
            }
        }

        // Send header and response data
        header('Content-Type: application/json');
        echo json_encode(array('results' => $result));
        exit;
    }
}

/* End of file Admin_menu_items.php */
/* Location: ./application/modules/menu/controllers/admin/Admin_menu_items.php */