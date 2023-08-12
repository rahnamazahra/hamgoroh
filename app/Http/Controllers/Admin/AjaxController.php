<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function showCitiesByProvince(Request $request)
    {
        $cities = City::where('province_id', $request->province_id)->get(['id', 'title']);

        return ['cities' => $cities];
    }

    public function showReferees()
    {
//        $referees  = User::whereHas('roles', function ($query) {
//            $query->where('slug', 'referee');
//        })->get(['id', 'first_name', 'last_name']);
        $referees  = Role::find(5)->users;
//        dd($referees);

        return ['referees' => $referees];
    }

    public function showGenerals()
    {
        $generals  = User::whereHas('roles', function ($query) {
            $query->where('slug', 'general_manager');
        })->get(['id', 'first_name', 'last_name']);

        return ['generals' => $generals];
    }

    public function showProvincials()
    {
        $provincials  = User::whereHas('roles', function ($query) {
            $query->where('slug', 'provincial_manager');
        })->get(['id', 'first_name', 'last_name']);

        return ['provincials' => $provincials];
    }

}
