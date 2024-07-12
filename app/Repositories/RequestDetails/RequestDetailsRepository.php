<?php

namespace App\Repositories\RequestDetails;

use Illuminate\Support\Facades\DB;
use App\Interfaces\RequestDetails\RequestDetailsInterface;

class RequestDetailsRepository implements RequestDetailsInterface 
{
    public function getDetails() {

        $getDetails = DB::table('request_details as d')
                    ->selectRaw('d.*')
                    ->orderBy('d.created_at', 'asc');

        return $getDetails;
    }
}