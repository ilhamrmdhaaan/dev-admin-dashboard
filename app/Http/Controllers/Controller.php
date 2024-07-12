<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function badge()
    {
        return $badge = collect([
            'primary',
            'secondary',
            'warning',
            'success',
            'info',
        ]);
    }

    public function roles()
    {
        return DB::table('roles')
            ->select('id', 'name')
            ->whereNotIn('name', ['super_admin'])
            ->get();
    }

    public function permissions()
    {
        return DB::table('permissions')
            ->select('id', 'name')
            ->whereNotIn('name', ['full_permission'])
            ->get();
    }

    public function division() {

        return DB::table('division')
            ->select('id', 'name')
            ->get();
    }

    public function findVehicle(int $vehicleId) {

        $vehicle = DB::table('request_vehicle')
                ->selectRaw('
                    id, email
                ')
                ->where('id', $vehicleId)
                ->first();

        return $vehicle;

    }
}
