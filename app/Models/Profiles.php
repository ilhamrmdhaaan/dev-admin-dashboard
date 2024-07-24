<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'user_id', 'email', 'name', 'phone'
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function requestVehicles() {
        return $this->hasOne(RequestVehicle::class);
    }
}
