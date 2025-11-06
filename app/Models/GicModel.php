<?php

namespace App\Models;

use CodeIgniter\Model;

class GicModel extends Model
{
    protected $table = 'gic';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'policy_number', 'amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
