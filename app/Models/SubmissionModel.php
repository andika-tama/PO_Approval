<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmissionModel extends Model
{
    protected $table      = 'submission';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_product', 'priority', 'date_needed', 'quantity'];

    protected $useTimestamps = FALSE;

    public function getData()
    {
        $db = db_connect();
        $builder = $db->table('submission');
        $builder->select('*')->join('product', 'product.id = submission.id_product')->where("priority = 'NO'")->orderBy('date_needed', 'ASC');
        $NotPriority = $builder->get()->getResultArray();

        $builder2 = $db->table('submission');
        $builder2->select('*')->join('product', 'product.id = submission.id_product')->where("priority = 'YES'")->orderBy('date_needed', 'ASC');
        $Priority = $builder2->get()->getResultArray();

        return array_merge_recursive($Priority, $NotPriority);
    }
}
