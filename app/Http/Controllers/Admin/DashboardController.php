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
        $users = DB::table('users')
        ->join('cities', 'users.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id')
        ->select('provinces.title', DB::raw('COUNT(*) as count'))
        ->groupBy('provinces.title')
        ->get();

        //$provinces = Province::select('title')->withCount('cities.users as count')->get();

        return response()->json($provinces);
    }
}
