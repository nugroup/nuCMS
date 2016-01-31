<?php

/**
 * nuBlox content parser library
 *
 * @author		Jacek Bednarek & Szymon Kulczynski
 * @copyright          Copyright (c) 2015-2016
 */
class NuBloxDecoder
{
    private $defaultCol = 12;

    public function decode($content, $format = 'json')
    {
        $result = '';

        if ($format == 'json') {
            $contentObject = json_decode($content)->_children;
        } else {
            $contentObject = $content;
        }

        foreach ($contentObject as $module) {

            // Create tmp module object to decode
            switch($module->type) {
                // --row
                case 'row':
                    $result .= $this->decodeModuleRow($module).PHP_EOL;
                    break;
                // --col
                case 'col':
                    $result .= $this->decodeModuleCol($module).PHP_EOL;
                    break;
            }

        }

        return $result;
    }

    /**
     * Decode row module
     *
     * @param object $module
     * @return string
     */
    public function decodeModuleRow($module)
    {
        $result = '';

        $result .= '<div class="row">'.PHP_EOL;

            if (isset($module->_children)) {
                $result .= $this->decode($module->_children, 'object').PHP_EOL;
            }

        $result .= '</div><!--/.row-->'.PHP_EOL;

        return $result;
    }

    /**
     * Decode col module
     *
     * @param object $module
     * @return string
     */
    public function decodeModuleCol($module)
    {
        $col_lg = (isset($module->colSize)) ? ' col-lg-'.$module->colSize : '';
        $col_md = (isset($module->col_md)) ? ' col-md-'.$module->col_md : '';
        $col_sm = (isset($module->col_sm)) ? ' col-sm-'.$module->col_sm : '';
        $col_xs = (isset($module->col_sm)) ? ' col-xs-'.$module->col_sm : '';

        $result = '';

        $result .= '<div class="'.$col_xs.$col_sm.$col_md.$col_lg.'">'.PHP_EOL;

            $result .= 'COL';

            if (isset($module->_children)) {
                $result .= $this->decode($module->_children, 'object').PHP_EOL;
            }

        $result .= '</div><!--/.col-->'.PHP_EOL;

        return $result;
    }
}

/* End of file nuBloxParser.php */
/* Location: ./application/libraries/nuBloxParser.php */