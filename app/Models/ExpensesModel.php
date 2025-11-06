<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpensesModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'category', 'amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
