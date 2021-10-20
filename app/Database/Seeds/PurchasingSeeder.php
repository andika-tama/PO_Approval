<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PurchasingSeeder extends Seeder
{
    public function run()
    {

        $data = [

            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => NULL,
                'gm_approved' => NULL,
                'cfo_approved' => NULL,
                'declined_desc' => NULL
            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => NULL,
                'cfo_approved' => NULL,
                'declined_desc' => NULL
            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Approved",
                'cfo_approved' => NULL,
                'declined_desc' => NULL
            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Approved",
                'cfo_approved' => "Approved",
                'declined_desc' => NULL
            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => NULL,
                'gm_approved' => NULL,
                'cfo_approved' => NULL,
                'declined_desc' => "Not Enough Budget! By XXX (Tittle XX)"
            ],
        ];

        // Using Query Builder
        $this->db->table('purchasing_list')->insertBatch($data);
    }
}
