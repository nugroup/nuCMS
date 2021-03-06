<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('generate_folder_tree')) {

    /**
     * Generate HTML with menu tree
     * 
     * @param array $items - array (key = parent_id)
     * @param int $parent_id - start id parent
     * @param array $active_path - full path of current category
     * @param int $max_level - maximum level
     * @param int $level - current level
     */
    function generate_files_folder_tree($items, $parent_id, $active_path = array(), $max_level = 100, $level = 0, $additionalData = array())
    {
        $result = '';
        $parent_id = (int) $parent_id;

        // home folder
        if ($parent_id == 0) {
            $activeHome = (in_array(0, $active_path)) ? ' class="active"' : '';
            $fileInHomeFolder = (isset($additionalData['files_in_home_folder'])) ? $additionalData['files_in_home_folder'] : 0;

            $result .= '<li id="item_0"' . $activeHome . '>' . PHP_EOL;
            $result .= '<a href="javascript:void(0);" class="ico openSubTree"><i class="fa fa-folder-o"></i></a>' . PHP_EOL;
            $result .= '<a href="javascript:void(0);" class="name txtBig loadFilesList" data-parent_id="0">' . lang('file.text.home_folder') . ' (' . $fileInHomeFolder . ')</a>' . PHP_EOL;
            $result .= '</li>' . PHP_EOL;
        }

        if (isset($items[$parent_id]) && $max_level > $level) {
            // files folder
            foreach ($items[$parent_id] as $item) {
                // Set active class and ico
                if (in_array($item->id, $active_path)) {
                    $activeClass = ' class="active"';
                    $ico = '<i class="fa fa-folder-open-o"></i>';
                } else {
                    $activeClass = '';
                    $ico = '<i class="fa fa-folder-o"></i>';
                }

                // Items with children
                if (isset($items[$item->id]) && count($items[$item->id]) > 0) {
                    $result .= '<li id="item_' . $item->id . '"' . $activeClass . '>' . PHP_EOL;
                    $result .= '<a href="javascript:void(0);" class="ico openSubTree">' . $ico . '</a>' . PHP_EOL;
                    $result .= '<a href="javascript:void(0);" class="name txtBig loadFilesList fileFolderName" data-parent_id="' . $item->id . '"><span class="insideName">' . $item->name . '</span> (' . $item->files_in_folder . ')</a>' . PHP_EOL;
                    $result .= form_input(['class' => 'form-control filefolderInput', 'value' => $item->name, 'data-parent_id' => $item->id]);
                    $result .= '<ul class="subtree">' . PHP_EOL;
                    $result .= generate_files_folder_tree($items, $item->id, $active_path, $max_level, $level + 1);
                    $result .= '</ul>' . PHP_EOL;
                    $result .= '</li>' . PHP_EOL;
                }
                // Items without children
                else {
                    $result .= '<li id="item_' . $item->id . '"' . $activeClass . '>' . PHP_EOL;
                    $result .= '<a href="javascript:void(0);" class="ico openSubTree">' . $ico . '</a>' . PHP_EOL;
                    $result .= '<a href="javascript:void(0);" class="name txtBig loadFilesList fileFolderName" data-parent_id="' . $item->id . '"><span class="insideName">' . $item->name . '</span> (' . $item->files_in_folder . ')</a>' . PHP_EOL;
                    $result .= form_input(['class' => 'form-control filefolderInput', 'value' => $item->name, 'data-parent_id' => $item->id]);
                    $result .= '</li>' . PHP_EOL;
                }
            }
        }

        return $result;
    }
}

if (!function_exists('generate_thumbnail')) {

    /**
     * Generate thumbnail for file
     *
     * @param object $file
     * @return string
     */
    function generate_thumbnail($file, $size = '', $alt = '', $title = '', $class = 'img-responsive')
    {
        $CI = & get_instance();
        $file_extension = extension($file->filename);
        $imgConfig = $CI->config->item('sizes', 'img');

        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
                $imgData = [
                    'alt' => $alt,
                    'title' => $title,
                    'class' => $class,
                ];

                if (isset($imgConfig[$size][0])) {
                    $imgData['width'] = $imgConfig[$size][0];
                    $imgData['height'] = $imgConfig[$size][1];

                    $result = $CI->img->rimg(config_item('upload_folder') . '/' . $file->filename, $imgData);
                } else {
                    $result = '<img src="' . config_item('upload_folder') . '/' . $file->filename . '" alt="' . $alt . '" title="' . $title . '" class="' . $class . '">';
                }

                break;
            case 'avi':
            case 'mp4':
            case 'mpeg':
            case 'rmvb':
                $result = '<i class="fa fa-file-video-o"></i>';
                break;
            case 'mp3':
            case 'wav':
            case 'midi':
                $result = '<i class="fa fa-file-audio-o"></i>';
                break;
            case 'zip':
            case 'rar':
            case 'tar':
            case 'gzip':
                $result = '<i class="fa fa-file-archive-o"></i>';
                break;
            case 'gif':
                $result = '<i class="fa fa-file-image-o"></i>';
                break;
            case 'xlsx':
            case 'xls':
                $result = '<i class="fa fa-file-excel-o"></i>';
                break;
            case 'doc':
            case 'docx':
            case 'dot':
            case 'odt':
                $result = '<i class="fa fa-file-word-o"></i>';
                break;
            case 'pdf':
                $result = '<i class="fa fa-file-pdf-o"></i>';
                break;
            case 'txt':
            case 'rtf':
                $result = '<i class="fa fa-file-text-o"></i>';
                break;
            default:
                $result = '<i class="fa fa-file-o"></i>';
                break;
        }

        return $result;
    }
}

if (!function_exists('is_image')) {

    /**
     * Chceck if file is image
     *
     * @param string $extension
     * @return boolean
     */
    function is_image($extension)
    {
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            return true;
        }

        return false;
    }
}

/* End of file file_helper.php */
/* Location: ./application/modules/menu/helpers/file_helper.php */