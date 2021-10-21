<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmissionModel extends Model
{
    protected $table      = 'submission';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_product', 'priority', 'date_needed', 'quantity', 'status_submission', 'total_price'];

    protected $useTimestamps = FALSE;

    // model untuk mengurutkan data berdasarkan priority
    public function getDataTask()
    {
        $db = db_connect();
        $builder = $db->table('submission');

        // Select * from submission join product where product.id = sum... AND priority = NO AND (status = waiting OR Declined) orderBy date needed ASC
        $builder->select('id')
            ->GroupStart()->orWhere("status_submission = 'Waiting'")->orWhere("status_submission = 'Declined'")
            ->groupEnd();
        $result = $builder->countAllResults();

        return $result;
    }

    public function getData()
    {
        $db = db_connect();
        $builder = $db->table('submission');

        // Select * from submission join product where product.id = sum... AND priority = NO AND (status = waiting OR Declined) orderBy date needed ASC
        $builder->select('*')
            ->join('product', 'product.id = submission.id_product')
            ->where("priority = 'NO'")
            ->GroupStart()->orWhere("status_submission = 'Waiting'")->orWhere("status_submission = 'Declined'")
            ->groupEnd()
            ->orderBy('date_needed', 'ASC');
        $NotPriority = $builder->get()->getResultArray();


        $builder2 = $db->table('submission');
        $builder2->select('*')
            ->join('product', 'product.id = submission.id_product')
            ->where("priority = 'YES'")
            ->GroupStart()
            ->orWhere('status_submission =', 'Waiting')
            ->orWhere('status_submission =', 'Declined')
            ->groupEnd()
            ->orderBy('date_needed', 'ASC');
        $Priority = $builder2->get()->getResultArray();

        return array_merge_recursive($Priority, $NotPriority);
    }


    public function getDataByIdPL($id_pl)
    {
        $db = db_connect();
        $builder = $db->table('submission');

        $result = $builder->select('submission.id')
            ->join('transaction', 'transaction.id_submission = submission.id')
            ->join('purchasing_list', 'purchasing_list.id = transaction.id_purchasing')
            ->where("purchasing_list.id", $id_pl)
            ->get()
            ->getResultArray();


        return $result;
    }
}
