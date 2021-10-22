<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'Iventory Manger',
            ],
            [
                'role_name' => 'Purchasing',
            ],
            [
                'role_name' => 'Purchase Manager',
            ],
            [
                'role_name' => 'General Manager',
            ],
            [
                'role_name' => 'CFO',
            ],
        ];

        // Using Query Builder
        $this->db->table('role')->insertBatch($data);
    }
}
