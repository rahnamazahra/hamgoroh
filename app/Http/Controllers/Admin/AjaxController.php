<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class AjaxController extends Controller
{
    public function showCitiesByProvince(Request $request)
    {
        $cities = City::where('provnce_id', $request->province_id)->get(['id', 'title']);

        return ['cities' => $cities];
    }

}
