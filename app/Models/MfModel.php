<?php

namespace App\Models;

use CodeIgniter\Model;

class MfModel extends Model
{
    protected $table = 'mf';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'scheme_name', 'investment_amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
