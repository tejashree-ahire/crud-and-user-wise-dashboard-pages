<?php

namespace App\Models;

use CodeIgniter\Model;

class LicModel extends Model
{
    protected $table = 'lic';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'policy_number', 'amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
