<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\DashboardInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardRepository;

    public function __construct(DashboardInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {

        $title = 'Dashboard';

        $totalRequest = formatAngka($this->dashboardRepository->totalRequest());
        $totalStatusApproved = formatAngka($this->dashboardRepository->totalStatusApproved());
        $totalStatusPending = formatAngka($this->dashboardRepository->totalStatusPending());
        $totalStatusCancel = formatAngka($this->dashboardRepository->totalStatusCancel());


        $total =
            [
                ['Total Today Request', $totalRequest],
                ['Total Today Approved', $totalStatusApproved],
                ['Total Today Pending', $totalStatusPending],
                ['Total Today Cancel', $totalStatusCancel],
            ];

        // return $total;

        return view('admin.dashboard.index', compact(
            'title',
            'total'
        ));
    }
}
