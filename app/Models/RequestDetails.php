<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDetails extends Model
{
    use HasFactory;

    protected $table = 'request_details';

    protected $fillable = [
        'request_vehicle_id', 'name', 'request_date', 'noted', 'nopol', 'driver', 'status'
    ];
}
