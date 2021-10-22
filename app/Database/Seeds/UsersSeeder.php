<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'william',
                'password'    => md5("william1"),
                'name' => "Willy William",
                'level_user' => 1
            ],
            [
                'username' => 'samy',
                'password'    => md5("samy1"),
                'name' => "Samuel Samy",
                'level_user' => 2
            ],
            [
                'username' => 'dani',
                'password'    => md5("dani1"),
                'name' => "Dani Daniel",
                'level_user' => 3
            ],
            [
                'username' => 'tio',
                'password'    => md5("tio1"),
                'name' => "Tio Tiono",
                'level_user' => 4
            ],
            [
                'username' => 'ruka',
                'password'    => md5("ruka1"),
                'name' => "Ruka Rumawa",
                'level_user' => 5
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
