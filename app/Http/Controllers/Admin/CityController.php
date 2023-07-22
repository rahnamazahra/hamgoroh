<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Province;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        try {
            City::create($request->all());
            return redirect()->route('admin.cities.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.cities.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    public function update(CityRequest $request, City $city)
    {
        try {
            $city->update($request->all());
            return redirect()->route('admin.cities.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.cities.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(City $city)
    {
        try {
            $city->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
