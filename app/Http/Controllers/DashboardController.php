<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardService $dashboardService
    ) {
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardSummary();

        return view('admin.index', $data);
    }

    public function tenantIndex()
    {
        $data = $this->dashboardService->getTenantDashboardSummary(Auth::id());

        return view('tenant.dashboard.index', $data);
    }
}
