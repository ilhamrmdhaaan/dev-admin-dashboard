<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestVehicle extends Model
{
    use HasFactory;

    protected $table = 'request_vehicle';

    protected $fillable = [
        'profile_id', 'email', 'request_date', 'maximum_person', 'division', 'direction', 'status', 'necessity'
    ];

    public function requestDetails()
    {
        return $this->hasMany(RequestDetails::class);
    }


}
