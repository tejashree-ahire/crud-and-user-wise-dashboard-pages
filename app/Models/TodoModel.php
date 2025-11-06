<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'task', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
