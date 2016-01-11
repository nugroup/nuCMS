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

/* End of file dump_helper.php */
/* Location: ./application/helpers/dump_helper.php */