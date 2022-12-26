<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * get list data for dashboard
     */
    public function index(DashboardService $dashboardService, $npsn)
    {
        return $dashboardService->index($npsn);
    }
}
