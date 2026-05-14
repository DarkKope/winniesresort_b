<?php

namespace App\Models;

use CodeIgniter\Model;

class CottageModel extends Model
{
    protected $table = 'cottages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'capacity', 'status', 'image'];
    protected $useTimestamps = true;
}