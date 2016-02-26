<?php

if ( ! function_exists('dump')) 
{
    /**
     * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
     *
     * @param mixed $var
     * @param string $label
     * @param boolean $echo
     * @return string
     */
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        print_r($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

if ( ! function_exists('extension'))
{
    /**
     * Get extension from string
     *
     * @param string $file_name
     * @return string
     */
    function extension($file_name)
    {
        $ex = explode(".", $file_name);
        $i = (count($ex) - 1);

        return strtolower($ex[$i]);
    }
}

if (!function_exists('admin_url')) {

    /**
     * Generate admin panel url
     *
     * @param string $url
     * @return string
     */
    function admin_url($url = '')
    {
        $CI =& get_instance();

        return $CI->config->item('admin_url').$url;
    }
}

if ( ! function_exists('clearDiacritics')) 
{
    /**
     * Clear diacritics from string
     *
     * @param string $sText
     * @return string
     */
    function clearDiacritics($sText)
    {
        //cyrylic transcription
        $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia');

        $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
        $to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");

        $from = array_merge($from, $cyrylicFrom);
        $to   = array_merge($to, $cyrylicTo);

        $newstring=str_replace($from, $to, $sText);
        return $newstring;
    }
}

if ( ! function_exists('prepareURL'))
{
    /**
     * Prepare url from string
     *
     * @param string $sText
     * @return string
     */
    function prepareURL($sText)
    {
        $sText = clearDiacritics($sText);
        $sText = strtolower($sText);
        $sText = str_replace(' ', '-', $sText);
        $sText = preg_replace('/[^0-9a-z\-\/]+/', '', $sText);
        $sText = preg_replace('/[\-]+/', '-', $sText);
        $sText = trim($sText, '-');

        return $sText;
    }
}

if ( ! function_exists('current_full_url'))
{
    /**
     * Get current url with GET query
     *
     * @return string
     */
    function current_full_url()
    {
        $CI =& get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
    }
}

if ( ! function_exists('obj_to_options_array'))
{
    /**
     * Prepare options for form select from object
     *
     * @param object $stdObj
     * @param string $primary_key
     * @param string $value_key
     * @return array
     */
    function obj_to_options_array($stdObj, $primary_key, $value_key)
    {
        $result = array('' => lang('text.choose'));

        if($stdObj) {
            foreach($stdObj as $obj) {
                $result[$obj->{$primary_key}] = $obj->{$value_key};
            }
        }

        return $result;
    }
}

if ( ! function_exists('form_nu_dropdown'))
{
    /**
     * Generate select dropdown in nuCMS style
     *
     * @param array $data
     * @param array $options
     * @param int $selected
     * @return string
     */
    function form_nu_dropdown($data, $options, $selected = null)
    {
        $result = '';

        if ($selected != null) {
            $selectedText = $options[$selected];
            $hiddenValue = $selected;
        } else {
            $selectedText = lang('text.choose');
            $hiddenValue = '';
        }

        // class
        if (isset($data['class'])) {
            $hiddenClass = ' class="'.$data['class'].'"';
        } else {
            $hiddenClass = '';
        }

        // required
        if (isset($data['required'])) {
            $hiddenRequired = ' required="'.$data['required'].'"';
        } else {
            $hiddenRequired = '';
        }

        $result .= '<span class="btn-group nuDropdown dropAsSelect">';
            $result .= '<span data-toggle="dropdown" class="txtBig" aria-expanded="false">';
                $result .= '<span data-name="'.$data['name'].'">'.$selectedText.'</span><i class="fa fa-angle-down"></i>';
            $result .= '</span>';
            $result .= '<ul class="dropdown-menu" style="display: none;">';
                foreach ($options as $key => $value) {
                    $result .= '<li data-value="'.$key.'"><span>'.$value.'</span></li>';
                }
            $result .= '</ul>';
            $result .= '<input type="hidden" name="'.$data['name'].'"'.$hiddenClass.' value="'.$hiddenValue.'"'.$hiddenRequired.'>';
        $result .= '</span>';

        return $result;
    }
}