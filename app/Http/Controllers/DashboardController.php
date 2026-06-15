<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

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
}