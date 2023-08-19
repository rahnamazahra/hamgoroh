<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Province;

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

    public function chartNumberUsersProvince()
    {
        $NumberUsersProvince = Province::select('title')->withCount('users as count')->get();

        return response()->json($NumberUsersProvince);
    }
}
