<?php

/**
 * Interface RouteModelInterface
 */
interface RouteTranslationsModelInterface
{
    /**
     * Get page route
     *
     * You have to run this function on after_get event
     * example:
     *
        // Load routes model
        $CI = & get_instance();
        $CI->load->model('route/route_model', 'route');

        if (!isset($data[0])) {

            $pageUrl = config_item('pages_route_controller').$data['page_id'].'/'.$data['locale'];
            $route = $CI->route
                ->fields('slug')
                ->where(['url' => $pageUrl])
                ->get();

            if ($route) {
                $data['slug'] = $route->slug;
                $data['token'] = $this->generate_token($data);
            }

        }

        return $data;
     *
     * @param array $data
     */
    public function get_route($data);
}