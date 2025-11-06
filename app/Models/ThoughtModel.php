<?php

namespace App\Models;

use CodeIgniter\Model;

class ThoughtModel extends Model
{
    protected $table = 'thought';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'message', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
