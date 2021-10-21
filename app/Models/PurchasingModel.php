<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchasingModel extends Model
{
    protected $table      = 'purchasing_list';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['date_needed', 'pm_approved', 'gm_approved', 'cfo_approved', 'created_by', 'total_cost', 'status'];
    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'created_at';

    public function getLastId()
    {
        $db = db_connect();
        $builder = $db->table('purchasing_list');
        $row = $builder->select("*")->limit(1)->orderBy('id', "DESC")->get()->getResultArray();

        return $row[0]['id'];
    }

    public function getWaitForApproval($role)
    {
        $db = db_connect();
        $builder = $db->table('purchasing_list');
        switch ($role) {
            case 3:
                $row = $builder->select("*")->where('pm_approved', "Waiting")->orderBy('date_needed', "ASC")->get()->getResultArray();
                break;
            case 4:
                $row = $builder->select("*")->where('gm_approved', "Waiting")->orderBy('date_needed', "ASC")->get()->getResultArray();
                break;
            case 5:
                $row = $builder->select("*")->where('cfo_approved', "Waiting")->orderBy('date_needed', "ASC")->get()->getResultArray();
                break;
        }
        return $row;
    }
}
