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
                'pm_approved' => "Waiting",
                'gm_approved' => NULL,
                'cfo_approved' => NULL,
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Proccess"

            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Declined",
                'gm_approved' => NULL,
                'cfo_approved' => NULL,
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Declined"

            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Waiting",
                'cfo_approved' => NULL,
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Proccess"

            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Approved",
                'cfo_approved' => "Waiting",
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Proccess"

            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Approved",
                'cfo_approved' => "Approved",
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Approved"

            ],
            [
                'created_at' => Time::Now(),
                'date_needed'    => date('2021-11-20'),
                'pm_approved' => "Approved",
                'gm_approved' => "Declined",
                'cfo_approved' => NULL,
                'created_by' => "Samy Samuel",
                'total_cost' => 3000000,
                'status' => "Declined"
            ],
        ];

        // Using Query Builder
        $this->db->table('purchasing_list')->insertBatch($data);
    }
}
