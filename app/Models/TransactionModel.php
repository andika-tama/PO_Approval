<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table      = 'transaction';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_purchasing', 'id_submission'];
    protected $useTimestamps = FALSE;
    // protected $createdField  = 'created_at';

    public function getIdSubByPL($id)
    {
        $db = db_connect();
        $builder = $db->table('transaction');

        $result = $builder->select('id_submission')
            ->where("id_purchasing", $id)
            ->get()
            ->getResultArray();


        return $result;
    }
    public function getIdByPL($id)
    {
        $db = db_connect();
        $builder = $db->table('transaction');

        $result = $builder->select('id')
            ->where("id_purchasing", $id)
            ->get()
            ->getResultArray();


        return $result;
    }
}
