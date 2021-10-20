<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    public function run()
    {

        for ($i = 1; $i < 35; $i++) {
            $priority = ($i % 7 == 0) ? "YES" : "NO";

            $data = [
                'id_product' => random_int(1, 30),
                'priority'    => $priority,
                'quantity' => random_int(1, 10),
                'date_needed' => date('2021-12-12'),

            ];

            // Using Query Builder
            $this->db->table('submission')->insert($data);
        }
    }
}
