<?php

namespace App\Models;

use CodeIgniter\Model;

class GoalModel extends Model
{
    protected $table = 'goal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'goal_name', 'target_date', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
