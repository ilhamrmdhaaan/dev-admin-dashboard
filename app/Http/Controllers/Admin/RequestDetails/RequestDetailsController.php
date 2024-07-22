<?php

namespace App\Http\Controllers\Admin\RequestDetails;

use Illuminate\Http\Request;
use App\Models\RequestDetails;
use App\Models\RequestVehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\RequestDetails\RequestDetailsInterface;

class RequestDetailsController extends Controller
{
    private $detailsRepository;
    public $perPage = 5;

    public function __construct(RequestDetailsInterface $detailsRepository)
    {
        $this->detailsRepository = $detailsRepository;
    }

    public function index() {

        $title = 'Request Details';
        $data = $this->detailsRepository->getDetails()
        ->paginate($this->perPage);
        $perPage = $this->perPage;
        $badge = $this->badge();


        return view('admin.master.details.index', compact(
            'title',
            'data',
            'perPage',
            'badge'
        ));

        
    }


    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $data = $this->detailsRepository->getDetails()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('d.id', 'like', '%' . $q . '%')
                        ->orWhere('d.name', 'like', '%' . $q . '%')
                        ->orWhere('d.nopol', 'like', '%' . $q . '%')
                        ->orWhere('d.driver', 'like', '%' . $q . '%');
                })
                ->paginate($this->perPage);
            return view('admin.master.details.fetch', compact(
                'data',
                'badge'
            ))
                ->render();
        }
    }


    public function storeDetails(Request $request) {


        try {        
    
            $data = new RequestDetails();
            
            $data['request_date'] = $request->request_date;
            $data['name'] = $request->name;
            $data['nopol'] = $request->nopol;
            $data['noted'] = $request->noted;
            $data['driver'] = $request->driver;
            $data->save();


            DB::commit();


            return response()->json([
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Successfully Insert Data',
                'url' => route('master-request-details.index')
            ]);

        } catch (\Exception $e) {
            
            DB::rollback();

            return $e;
        }

    }


}
