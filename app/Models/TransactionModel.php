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
}
