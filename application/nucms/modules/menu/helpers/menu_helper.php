<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if ( ! function_exists('generate_menu_tree')) 
{
    /**
     * Generate HTML with menu tree
     * 
     * @param array $items - array (key = id_parent)
     * @param int $id_parent - start id parent
     * @param array $active_path - full path of current category
     * @param int $max_level - maximum level
     * @param int $level - current level
     */
    function generate_menu_tree($items, $id_parent, $active_path = array(), $max_level = 100, $level = 0, $data_arrays = [])
    {
        $result = '';
        $id_parent = (int) $id_parent;

        if(isset($items[$id_parent]) && $max_level > $level)
        {
            foreach ($items[$id_parent] as $item)
            {
                // Items with children
                if(isset($items[$item->id]) && count($items[$item->id]) > 0)
                {
                    $result .= '<li id="item_' . $item->id. '">' . PHP_EOL;
                        $result .= generate_menu_item_content($item, $data_arrays);
                        $result .= '<ol class="subtree">' . PHP_EOL;
                            $result .= generate_menu_tree($items, $item->id, $active_path, $max_level, $level + 1, $data_arrays);
                        $result .= '</ol>' . PHP_EOL;
                    $result .= '</li>' . PHP_EOL;
                }
                // Items without children
                else
                {
                    $result .= '<li id="item_' . $item->id. '">' . PHP_EOL;
                        $result .= generate_menu_item_content($item, $data_arrays);
                    $result .= '</li>' . PHP_EOL;
                }
            }
        }

        return $result;
    }
}

if ( ! function_exists('generate_menu_item_content'))
{
    function generate_menu_item_content($item, $data_arrays)
    {
        $icons = array(
            1 => '<i class="ion ion-link"></i>',
            2 => '<i class="fa fa-file-o"></i>',
            3 => '<i class="fa fa-cog"></i>',
        );

        $result = '';

        $result .= '<div class="handler">';
            $result .= $icons[$item->type];
            $result .= '<span class="menu_item_name">'.$item->name.'</span>';
            $result .= '<a rel="'.$item->id.'" href="'.admin_url('menu-items/delete').'" class="deleteRecord delete_item_single" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.lang('menu.text.delete').'" data-confirmMsg="'.lang('menu.item.text.confirm_delete').'">';
                $result .= '<i class="ion ion-android-delete"></i>';
            $result .= '</a>';
            $result .= '<span class="toggle" data-contentId="#menu_content_'.$item->id.'"><i class="ion ion-arrow-down-b"></i></span>';
        $result .= '</div>';

        $result .= '<div id="menu_content_'.$item->id.'" class="content">';
            $result .= '<div class="form-group">';
                $result .= '<label for="item_name_'.$item->id.'" class="col-xs-12 control-label">'.lang('menu.form.name').':</label>';
                $result .= '<div class="col-xs-12">';
                    $result .= '<input type="text" name="name" id="item_name_'.$item->id.'" class="form-control menu_item_'.$item->id.'" value="'.$item->name.'">';
                $result .= '</div>';
            $result .= '</div>';

            // static links
            if ($item->type == 1) {

                $result .= '<div class="form-group">';
                    $result .= '<label for="item_url_'.$item->id.'" class="col-xs-12 control-label">'.lang('menu.form.slug').':</label>';
                    $result .= '<div class="col-xs-12">';
                        $result .= '<input type="text" name="url" id="item_url_'.$item->id.'" class="form-control menu_item_'.$item->id.'" value="'.$item->url.'">';
                    $result .= '</div>';
                    $result .= '<div class="clearfix"></div>';
                $result .= '</div>';

            }

            // pages
            if ($item->type == 2 && isset($data_arrays['pages'])) {

                $result .= '<div class="form-group">';
                    $result .= '<label for="item_url_'.$item->id.'" class="col-xs-12">'.lang('menu.type.pages').':</label>';
                    $result .= '<div class="col-xs-12">';
                        $data = array('class' => 'form-control menu_item_'.$item->id.'', 'name' => 'primary_key', 'required' => 'required');
//                        $result .= form_nu_dropdown($data, $data_arrays['pages'], $item->primary_key);
                    $result .= '</div>';
                    $result .= '<div class="clearfix"></div>';
                $result .= '</div>';

            }

            $result .= '<div class="form-group">';
                $result .= '<div class="col-xs-12">';
                    $result .= '<button type="submit" class="btn btn-save menu_save" data-id="'.$item->id.'" data-menu_type="'.$item->type.'">'.lang('save').'</button>';
                $result .= '</div>';
                $result .= '<div class="clearfix"></div>';
            $result .= '</div>';
            $result .= '<input type="hidden" name="menu_items['.$item->id.'][type]" value="'.$item->type.'">';
        $result .= '</div>';

        return $result;
    }
}

/* End of file menu_helper.php */
/* Location: ./application/modules/menu/helpers/menu_helper.php */