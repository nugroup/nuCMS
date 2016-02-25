<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class UserFixture
 */
class UserFixture implements FixturesInterface
{
    public function load()
    {
        $CI = & get_instance();
        $CI->load->model('user/user_model', 'user');

        $faker = Faker\Factory::create();

        $CI->db->query('TRUNCATE TABLE nu_user');

        // Hash default password
        $pass = hash('sha512', 'admin#123'.config_item('encryption_key'));

        // Load admin data
        $data = [
            'login' => 'admin',
            'email' => 'admin@nucms.com',
            'name' => 'Admin',
            'password' => $pass,
        ];

        $CI->user->insert($data);

        for ($i = 1; $i < 100; $i++) {
            $firstName = $faker->unique()->firstName;
            $lastName = $faker->unique()->lastName;

            $data = [
                'login' => strtolower($firstName),
                'email' => strtolower($firstName).'@nucms.pl',
                'name' => $firstName.' '.$lastName,
                'password' => $pass,
            ];

            $CI->user->insert($data);
        }
    }
}