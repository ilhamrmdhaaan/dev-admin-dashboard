<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\DB;
use App\Interfaces\Dashboard\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public function totalRequest()
    {
        $totalRequest = DB::table('request_vehicle as r')
            ->select('r.id')
            ->whereDate('r.created_at', now())
            ->count();

        return $totalRequest;
    }


    public function totalStatusApproved()
    {
        $totalStatus = DB::table('request_vehicle as r')
            ->select('r.id')
            ->where('r.status', '=', 'Approved')
            ->whereDate('r.created_at', now())
            ->count();

        return $totalStatus;
    }

    public function totalStatusPending()
    {
        $totalStatus = DB::table('request_vehicle as r')
            ->select('r.id')
            ->where('r.status', '=', 'Pending')
            ->whereDate('r.created_at', now())
            ->count();

        return $totalStatus;
    }

    public function totalStatusCancel()
    {
        $totalStatus = DB::table('request_vehicle as r')
            // ->leftJoin('request_details as d', 'r.id', '=', 'd.request_vehicle_id')
            ->select('r.id')
            ->where('r.status', '=', 'Cancel')
            ->whereDate('r.created_at', now())
            ->count();

        return $totalStatus;
    }
}
