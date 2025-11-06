<?php

namespace App\Models;

use CodeIgniter\Model;

class LetterModel extends Model
{
    protected $table = 'letter';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'subject', 'content', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
