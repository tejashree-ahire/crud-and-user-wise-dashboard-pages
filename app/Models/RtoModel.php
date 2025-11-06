<?php

namespace App\Models;

use CodeIgniter\Model;

class RtoModel extends Model
{
    protected $table = 'rto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'vehicle_no', 'registration_date', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
