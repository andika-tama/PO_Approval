<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name_product', 'price'];

    protected $useTimestamps = FALSE;
}
