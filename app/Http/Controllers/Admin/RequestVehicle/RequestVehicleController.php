<?php

namespace App\Http\Controllers\Admin\RequestVehicle;

use Illuminate\Http\Request;
use App\Models\RequestVehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;
use App\Models\RequestDetails;

class RequestVehicleController extends Controller
{

    private $vehicleRepository;
    public $perPage = 5;

    public function __construct(RequestVehicleInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }


    public function index()
    {

        $title = 'Request Vehicle';
        $data = $this->vehicleRepository->getAll()
            ->paginate($this->perPage);
        $perPage = $this->perPage;
        $badge = $this->badge();

        $findDivision = $this->division();


        // return $data;

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


    public function show(RequestVehicle $requestVehicle)
    {

        $data = RequestVehicle::select([
            'request_vehicle.id',
            'request_vehicle.email',
            'request_vehicle.request_date',
            'request_vehicle.maximum_person',
            'request_vehicle.division',
            'request_vehicle.direction',
            'request_vehicle.necessity',
            'request_vehicle.status',

        ])
            ->where('request_vehicle.id', $requestVehicle->id)
            ->first();


        return response()->json([
            'data' => $data
        ], 200);
    }


    public function store(Request $request)
    {
        $attr = $request->all();

        try {

            $data = new RequestVehicle();
            $data['email'] = $request->email;
            $data['request_date'] = $request->request_date;
            $data['maximum_person'] = $request->maximum_person;
            $data['division'] = $request->division;
            $data['direction'] = $request->direction;
            $data['necessity'] = $request->necessity;
            $data['status'] = $request->status;
            $data->save();

            // Data untuk tabel request_details
            $requestDetailsData = RequestDetails::create([
                'request_vehicle_id' => $data->id,
                'request_date' => $request->request_date,
                'noted' => $request->noted
            ]);

            // dd($requestDetailsData);

            DB::commit();

            return response()->json([
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Successfully Add Data',
                'url' => route('request-vehicle.index')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function update(RequestVehicle $requestVehicle, Request $request)
    {

        $attr = $request->all();

        try {

            $findDetails['request_vehicle_id'] = RequestDetails::find($requestVehicle->id);

            $requestVehicle->update([
                'email' => $attr['email'],
                'request_date' => $attr['request_date'],
                'maximum_person' => $attr['maximum_person'],
                'division' => $attr['division'],
                'direction' => $attr['direction'],
                'necessity' => $attr['necessity'],
                'status' => $attr['status'],
            ]);



            $updatedRequestVehicle = DB::table('request_details')
                ->where('id', $requestVehicle->id)
                ->update([
                    'name' => $request->name,
                    'noted' => $request->noted,
                    'request_date' => $request->request_date,
                    'status' => $request->status
                ]);

            DB::commit();

            return response()->json([
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Successfully Updated Data',
                'url' => route('request-vehicle.index')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function remove(RequestVehicle $requestVehicle, Request $request)
    {

        try {

            // Temukan data request_vehicle berdasarkan ID
            $findVehicle = RequestVehicle::findOrFail($requestVehicle->id);

            // Hapus data request_vehicle beserta request_details yang berelasi
            $requestVehicle->delete();

            DB::commit();

            return response()->json([
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Remove Data Successfully',
                'url' => route('request-vehicle.index')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
