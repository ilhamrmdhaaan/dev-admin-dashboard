<?php

namespace App\Repositories\FormRequestVehicle;

use App\Models\Profiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\FormRequestVehicle\FormRequestVehicleInterface;

class FormRequestVehicleRepository implements FormRequestVehicleInterface 
{
    public function getVehicle() {

        $getVehicle = DB::table('request_vehicle as v')
        ->selectRaw('v.*')
        ->orderBy('v.created_at', 'asc');

        return $getVehicle;
    }

    // public function getAll() {
    //     $userId = Auth::user();
    //     $findProfile = Profiles::findOrFail($userId->id)->first();

    //     $getAll = DB::table('request_vehicle as v')
    //         ->leftJoin('profiles as p', 'v.profile_id', '=', 'p.id')
    //         ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
    //         ->leftJoin('request_details as d', 'v.id', '=' ,'d.request_vehicle_id')
    //         ->selectRaw('
    //                 v.id as r_vehicle_id, d.id as r_details_id, 
    //                 d.request_vehicle_id, v.request_date, d.name, v.email, v.maximum_person, v.division, v.direction, v.necessity, v.status, d.noted
    //         ')
    //         ->where('p.user_id', '=', $findProfile)
    //         ->orderBy('v.created_at', 'asc');

    //         return $getAll;
    //     }

    public function getall() {

        $userId = Auth::user();

        $findProfile = Profiles::where('id', $userId->id)->first();
        
        
        $getAll = DB::table('users as u')
                    ->leftjoin('profiles as p', 'p.user_id', '=', 'u.id')
                    ->join('request_vehicle as v', 'p.id', '=', 'v.profile_id')
                    ->join('request_details as d', 'v.id', '=', 'd.request_vehicle_id')
                    ->selectRaw('
                        u.id, p.user_id, p.email, p.name, v.email, v.request_date,
                        v.maximum_person, v.division, v.direction, v.necessity, v.status,
                        d.driver, d.nopol, d.noted
                    ')
                    ->where('p.user_id', '=', $findProfile->id)
                    ->orderBy('p.created_at', 'asc');
        
        return $getAll;
    }
    
}