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
        $referees  = Role::find(5)->users;

        return ['referees' => $referees];
    }

    public function showGenerals()
    {
        $generals  = Role::find(3)->users;

        return ['generals' => $generals];
    }

    public function showProvincials()
    {
        $provincials  = Role::find(4)->users;

        return ['provincials' => $provincials];
    }

}
