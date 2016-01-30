<?php

/**
 * Interface RouteModelInterface
 */
interface RouteModelInterface
{
    /**
     * You have to run this function on before/after delete
     * example:
        $this->db->like('url', config_item('pages_route_controller').$data['id']);
        $this->db->delete('nu_route');

        $CI =& get_instance();
        $CI->load->model('route/route_model', 'route');
        $CI->route->save_routes();
     *
     * @param array $data
     */
    public function delete_route($data);
}