<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table = 'bill';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'bill_no', 'amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
