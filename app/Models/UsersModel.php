<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'name', 'level_user'];

    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
