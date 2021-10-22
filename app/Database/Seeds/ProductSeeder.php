<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {

        for ($i = 1; $i < 2; $i++) {
            $data = [
                'name_product' => 'Product XX-' . $i,
                'price'    => random_int(10000, 500000),
            ];

            // Using Query Builder
            $this->db->table('product')->insert($data);
        }
    }
}
