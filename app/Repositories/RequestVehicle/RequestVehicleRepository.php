<?php

namespace App\Repositories\RequestVehicle;

use Illuminate\Support\Facades\DB;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;

class RequestVehicleRepository implements RequestVehicleInterface 
{
    public function getVehicle() {

        $getVehicle = DB::table('request_vehicle as v')
        ->selectRaw('v.*')
        ->orderBy('v.created_at', 'asc');

        return $getVehicle;
    }

    public function getAll() {

        $getAll = DB::table('request_vehicle as v')
            ->leftJoin('request_details as d', 'v.id', '=' ,'d.request_vehicle_id')
            ->selectRaw('
                    v.id as r_vehicle_id, d.id as r_details_id, 
                    d.request_vehicle_id, v.request_date, d.name, v.email, v.maximum_person, v.division, v.direction, v.necessity, v.status, d.noted
            ')
            ->orderBy('v.created_at', 'asc');

            return $getAll;
        }
    
}