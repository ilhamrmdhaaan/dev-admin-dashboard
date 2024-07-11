<?php

namespace App\Http\Controllers\Admin\RequestVehicle;

use App\Http\Controllers\Controller;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;
use App\Models\RequestVehicle;
use Illuminate\Http\Request;

class RequestVehicleController extends Controller
{

    private $vehicleRepository;
    public $perPage = 5;

    public function __construct(RequestVehicleInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }


    public function index() {

        $title = 'Request Vehicle';
        $data = $this->vehicleRepository->getVehicle()
        ->paginate($this->perPage);
        $perPage = $this->perPage;
        $badge = $this->badge();

        $findDivision = $this->division();


        // return $findDivison;

        return view('admin.master.vehicle.index', compact(
            'title',
            'data',
            'badge',
            'perPage',
            'findDivision'
        ));
    }


    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $status = $request->get('status');

            $data = $this->vehicleRepository->getVehicle()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('v.id', 'like', '%' . $q . '%')
                        ->orWhere('v.email', 'like', '%' . $q . '%');
                        // ->orWhere('v.nama', 'like', '%' . $q . '%')
                        // ->orWhere('v.tanggal_lahir', 'like', '%' . $q . '%');
                })
                ->when($status ?? false, function ($query) use ($status) {
                    if ($status == 'semua') {
                        return false;
                    }
                    return $query->where('v.status', $status);
                })
                ->paginate($this->perPage);
            return view('admin.master.vehicle.fetch', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }


    public function show(RequestVehicle $requestVehicle) {

        $data = RequestVehicle::select([
            'request_vehicle.id',
            'request_vehicle.email',
            'request_vehicle.request_date'
        ])
        ->where('request_vehicle.id', $requestVehicle->id)
        ->first();

        // return $data;

        return response()->json([
            'data' => $data
        ], 200);

    }


    public function update(RequestVehicle $requestVehicle) {

        // 
    }

}
