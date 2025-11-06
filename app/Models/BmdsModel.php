<?php

namespace App\Models;

use CodeIgniter\Model;

class BmdsModel extends Model
{
    protected $table = 'bmds';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'details', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
