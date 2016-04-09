<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if ( ! function_exists('generate_folder_tree')) 
{
    /**
     * Generate HTML with menu tree
     * 
     * @param array $items - array (key = parent_id)
     * @param int $parent_id - start id parent
     * @param array $active_path - full path of current category
     * @param int $max_level - maximum level
     * @param int $level - current level
     */
    function generate_files_folder_tree($items, $parent_id, $active_path = array(), $max_level = 100, $level = 0)
    {
        $result = '';
        $parent_id = (int) $parent_id;

        if(isset($items[$parent_id]) && $max_level > $level)
        {
            foreach ($items[$parent_id] as $item)
            {
                $ico = (in_array($item->id, $active_path)) ? '<i class="fa fa-folder-open-o"></i>' : '<i class="fa fa-folder-o"></i>';

                // Items with children
                if(isset($items[$item->id]) && count($items[$item->id]) > 0)
                {
                    $result .= '<li id="item_' . $item->id. '">' . PHP_EOL;
                        $result .= '<a href="javascript:void(0);" class="ico">'.$ico.'</a>' . PHP_EOL;
                        $result .= '<a href="javascript:void(0);" class="name txtBig">'.$item->name.'</a>' . PHP_EOL;
                        $result .= '<ul class="subtree">' . PHP_EOL;
                            $result .= generate_files_folder_tree($items, $item->id, $active_path, $max_level, $level + 1);
                        $result .= '</ul>' . PHP_EOL;
                    $result .= '</li>' . PHP_EOL;
                }
                // Items without children
                else
                {
                    $result .= '<li id="item_' . $item->id. '">' . PHP_EOL;
                        $result .= '<a href="javascript:void(0);" class="ico">'.$ico.'</a>' . PHP_EOL;
                        $result .= '<a href="javascript:void(0);" class="name txtBig">'.$item->name.'</a>' . PHP_EOL;
                    $result .= '</li>' . PHP_EOL;
                }
            }
        }

        return $result;
    }
}

/* End of file file_helper.php */
/* Location: ./application/modules/menu/helpers/file_helper.php */