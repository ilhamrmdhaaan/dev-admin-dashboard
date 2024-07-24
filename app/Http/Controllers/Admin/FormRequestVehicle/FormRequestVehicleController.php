<?php

namespace App\Http\Controllers\Admin\FormRequestVehicle;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Models\RequestDetails;
use App\Models\RequestVehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\FormRequestVehicle\FormRequestVehicleInterface;

class FormRequestVehicleController extends Controller
{
    private $formvehicleRepository;
    public $perPage = 5;

    public function __construct(FormRequestVehicleInterface $formvehicleRepository)
    {
        $this->formvehicleRepository = $formvehicleRepository;
    }
    

    public function index() {
        $title = 'Request Vehicle';
        $data = $this->formvehicleRepository->getAll()
        ->paginate($this->perPage);
        $perPage = $this->perPage;
        $badge = $this->badge();
        $findDivision = $this->division();

        // return $data;
        
        return view('admin.user.index', compact(
            'title',
            'data',
            'perPage',
            'badge',
            'findDivision'
        ));
    }


    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $status = $request->get('status');

            $data = $this->formvehicleRepository->getVehicle()
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
            return view('admin.user.fetch', compact(
                'data',
                'badge'
            ))
                ->render();
            return $data;
        }
    }


    // public function create()
    // {
    //     $title = 'Form Add Request';
    //     $findDivision = $this->division();

    //     return view('admin.user.create', compact(
    //         'title',
    //         'findDivision'
    //     ));
    // }

    public function store(VehicleRequest $request) {
        $attr = $request->all();

        try {
          

            $findProfile = Profiles::where('email', $request->email)->first();
            // dd($findProfile);
            
            $data = new RequestVehicle();
            $data['profile_id'] = $findProfile->id;
            $data['email'] = $request->email;
            $data['request_date'] = $request->request_date;
            $data['maximum_person'] = $request->maximum_person;
            $data['division'] = $request->division;
            $data['direction'] = $request->direction;
            $data['necessity'] = $request->necessity;
            $data['status'] = "Pending";
            $data->save();

            // Data untuk tabel request_details
            $requestDetailsData = RequestDetails::create([
                'request_vehicle_id' => $data->id,
                'request_date' => $request->request_date,
                'status' => "Pending",
                'noted' => $request->noted
            ]);


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
}
