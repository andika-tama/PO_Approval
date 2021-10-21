<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TransactionSeeder extends Seeder
{
    public function run()
    {

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'id_purchasing' => random_int(1, 5),
                'id_submission'    => random_int(1, 25),
            ];
            // Using Query Builder
            $this->db->table('transaction')->insert($data);
        }
    }
}
