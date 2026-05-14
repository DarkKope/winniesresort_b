<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'cottage_id', 'check_in', 'check_out', 'guests', 'total', 'status'];
    protected $useTimestamps = true;
}