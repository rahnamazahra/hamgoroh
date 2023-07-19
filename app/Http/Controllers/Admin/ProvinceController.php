<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Throwable;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('query');
        $provinces = Province::where('title', 'LIKE', '%' . $query . '%')->paginate(15);
        return view('admin.provinces.index', ['provinces' => $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Province::create($request->all());
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        try {
            $province->update($request->all());
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Province $province)
    {
        try {
            $province->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
