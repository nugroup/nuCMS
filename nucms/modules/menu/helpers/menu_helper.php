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
                $dataAttr = '';
                $tmpItem = clone $item;
                unset($tmpItem->sort);
                unset($tmpItem->locale);
                unset($tmpItem->menu_id);
                unset($tmpItem->id_parent);
                foreach ($tmpItem as $key => $value) {
                    $dataAttr .= ' data-'.$key.'="'.$value.'"';
                }

                // Items with children
                if(isset($items[$item->id]) && count($items[$item->id]) > 0)
                {
                    $result .= '<li id="item_' . $item->id. '"'.$dataAttr.'>' . PHP_EOL;
                        $result .= generate_menu_item_handler($item);
                        $result .= '<ol class="subtree">' . PHP_EOL;
                            $result .= generate_menu_tree($items, $item->id, $active_path, $max_level, $level + 1, $data_arrays);
                        $result .= '</ol>' . PHP_EOL;
                    $result .= '</li>' . PHP_EOL;
                }
                // Items without children
                else
                {
                    $result .= '<li id="item_' . $item->id. '"'.$dataAttr.'>' . PHP_EOL;
                        $result .= generate_menu_item_handler($item, $data_arrays);
                    $result .= '</li>' . PHP_EOL;
                }
            }
        }

        return $result;
    }
}

if ( ! function_exists('generate_menu_item_handler'))
{
    /**
     * Generate menu item handler for nested sortable
     *
     * @param object $item
     * @return string
     */
    function generate_menu_item_handler($item)
    {
        $icons = array(
            1 => '<i class="fa fa-link ico"></i>',
            2 => '<i class="fa fa-file ico"></i>',
        );

        $result = '';

        $result .= '<div class="handler">';
            $result .= $icons[$item->type];
            $result .= '<span class="menu_item_name">'.$item->name.'</span>';

            $result .= '<div class="nuButtonList">';
                $result .= '<div class="iconItem"><a href="javascript: void(0)" rel="'.$item->id.'" class="menuEdit"><i class="fa fa-pencil tableActions-edit" aria-hidden="true"></i></a></div>';
                $result .= '<div class="iconItem dropdown">';
                    $result .= '<button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>';
                    $result .= '<div class="dropdown-menu dropdown-menu-right">';
                        $result .= '<div><a rel="'.$item->id.'" class="menuDelete"><i class="fa fa-trash tableActions-delete"></i>'.lang('text.delete').'</a></div>';
                    $result .= '</div>';
                $result .= '</div>';
            $result .= '</div>';
            
            $result .= '<div class="editItemInputs" data-item_id="'.$item->id.'"></div>';
        $result .= '</div>';

        return $result;
    }
}

/* End of file menu_helper.php */
/* Location: ./application/modules/menu/helpers/menu_helper.php */
//
//<ul class="nuButtonsList">
//    <li>
//        <div class="dropdown open">
//            <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
//            <ul class="dropdown-menu dropdown-menu-right">
//                <li><a href="http://localhost/~xprezesx/nucms/admin/menu/edit/2"><i class="fa fa-pencil"></i>Edytuj</a></li>
//                <li role="separator" class="divider"></li>
//                <li>
//                    <a href="http://localhost/~xprezesx/nucms/admin/menu/delete" rel="2" class="deleteRecord" data-confirmmsg="Czy na pewno chcesz usunąć to menu?"><i class="fa fa-trash"></i>Usuń</a>
//                </li>
//            </ul>
//        </div>
//    </li>
//</ul>