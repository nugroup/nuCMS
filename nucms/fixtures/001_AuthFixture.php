<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class AuthFixture
 */
class AuthFixture implements FixturesInterface
{
    public function load()
    {
        $CI = & get_instance();
        $CI->load->library('auth/ion_auth');

        $CI->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $CI->db->query('TRUNCATE TABLE nu_group');
        $CI->db->query('TRUNCATE TABLE nu_user');
        $CI->db->query('TRUNCATE TABLE nu_user_group');
        $CI->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Load group
        $CI->ion_auth->create_group('admin', 'Administrator');
        $CI->ion_auth->create_group('editors', 'Edytor');

        // Load user
        $additional_data = [
            'username'    => 'admin',
            'email'       => 'admin@nucms.com',
            'first_name'  => 'Admin',
        ];

        $CI->ion_auth->register('username', 'admin#123', 'admin@nucms.com', $additional_data);

        // Load user group
        $CI->ion_auth->add_to_group(2, 1);
    }
}