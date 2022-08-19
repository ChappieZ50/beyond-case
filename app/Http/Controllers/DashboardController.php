<?php

namespace App\Http\Controllers;


use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index(DashboardService $service)
    {
        return view('index')->with('analytic', $service->analytics());
    }
}
