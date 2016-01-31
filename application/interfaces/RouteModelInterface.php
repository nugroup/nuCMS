<?php

/**
 * Interface RouteModelInterface
 */
interface RouteModelInterface
{
    /**
     * You have to run this function on before_delete/after_delete event
     * example:
     *
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');
        $CI->route->delete([
            'module' => 'page',
            'primary_key' => $data['id'],
        ]);
     *
     * @param array $data
     */
    public function delete_route($data);
}