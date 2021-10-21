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
    public function getData()
    {
        $db = db_connect();
        $builder = $db->table('submission');

        // nanti tambahkan where status not approved!
        $builder->select('*')->join('product', 'product.id = submission.id_product')->where("priority = 'NO'")->orderBy('date_needed', 'ASC');
        $NotPriority = $builder->get()->getResultArray();

        $builder2 = $db->table('submission');
        $builder2->select('*')->join('product', 'product.id = submission.id_product')->where("priority = 'YES'")->orderBy('date_needed', 'ASC');
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
