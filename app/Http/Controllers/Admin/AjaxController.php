<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class AjaxController extends Controller
{
    public function showCitiesByProvince(Request $request)
    {
        $cities = City::where('province_id', $request->province_id)->get(['id', 'title']);

        return ['cities' => $cities];
    }

}
