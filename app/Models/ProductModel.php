<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name_product', 'price'];

    protected $useTimestamps = FALSE;

    public function getDataNotSubmitted()
    {
        $db = db_connect();
        $builder = $db->table('product');

        $result = $builder->select('*')
            ->where('product.id NOT IN (select id_product from submission)', NULL, FALSE)
            ->get()
            ->getResultArray();

        return $result;
    }
}
