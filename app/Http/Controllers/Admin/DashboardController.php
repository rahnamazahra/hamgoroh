<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        return view('admin.index');
    }

    public function generalIndex()
    {
        return view('admin.dashboards.general_dashboard');
    }

    public function provincialIndex()
    {
        return view('admin.dashboards.provincial_dashboard');
    }
}
