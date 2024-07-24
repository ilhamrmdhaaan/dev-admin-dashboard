<?php

namespace App\Http\Controllers\Admin\RequestVehicle;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Models\RequestDetails;
use App\Models\RequestVehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VehicleRequest;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;

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

            $data = $this->vehicleRepository->getAll()
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
        $title = 'Form Updated Request';

        $data = DB::table('request_vehicle as v')
                ->leftJoin('request_details as d', 'v.id', '=' ,'d.request_vehicle_id')
                ->selectRaw('
                    v.id as r_vehicle_id, d.id as r_details_id, v.profile_id, 
                    d.request_vehicle_id, v.request_date, d.name, v.email, v.maximum_person, 
                    v.division, v.direction, v.necessity, v.status, d.noted, d.nopol, d.driver,
                    d.status
                ')
                ->where('v.id', $requestVehicle->id)
                ->first();

        $findDivision = $this->division();

        // return $data;

        return view('admin.master.vehicle.update', compact(
            'title',
            'data',
            'findDivision'
        ));
        
    }

   


    public function store(VehicleRequest $request)
    {
        $attr = $request->all();

        try {
        
            $findProfiles = Profiles::where('email', $request->email)->first();

            if (!$findProfiles) {
                return response()->json([
                    'status_code' => 400,
                    'status' => 'Failed',
                    'message' => 'User Not Found'
                ]);

            } else {

                $data = new RequestVehicle();
                $data['profile_id'] = $findProfiles->id;
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
                    'status' => $request->status,
                    'noted' => $request->noted
                ]);
    
                
                DB::commit();
    
                return response()->json([
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'Successfully Add Data',
                    'url' => route('master-request-vehicle.index')
                ]);
            }
            
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

 

    public function updated(Request $request, $id)
    {

        $attr = $request->all();
        // dd($attr);

        try {

            $findVehicle = RequestVehicle::findOrFail($id);
            $findDetails = RequestDetails::findOrFail($id);
            $findProfiles = Profiles::where('email', $request->email)->first();

            
            if (!$findProfiles) {
                return response()->json([
                    'status_code' => 400,
                    'failed' => 'Failed',
                    'message' => 'Email Not Found'
                ]);

            } else {
               

                $findVehicle->update([
                    'profile_id' => $findProfiles->id,
                    'email' => $attr['email'],
                    'request_date' => $attr['request_date'],
                    'maximum_person' => $attr['maximum_person'],
                    'division' => $attr['division'],
                    'direction' => $attr['direction'],
                    'necessity' => $attr['necessity'],
                    'status' => $attr['status'],
                ]);
    
    
    
                $updatedRequestVehicle = DB::table('request_details')
                    ->where('id', $findDetails->id)
                    ->update([
                        'name' => $request->name,
                        'noted' => $request->noted,
                        'nopol' => $request->nopol,
                        'driver' => $request->driver,
                        'request_date' => $request->request_date,
                        'status' => $request->status
                    ]);
    
                DB::commit();
    
                return response()->json([
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'Successfully Updated Data',
                    'url' => route('master-request-vehicle.index')
                ]);
            }
            

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
                'url' => route('master-request-vehicle.index')
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
