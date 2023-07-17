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
        return view('provinces.index', ['provinces' => $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Province::create($request->all());
            return redirect()->route('provinces.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
            return redirect()->route('provinces.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        try {
            $province->update($request->all());
            return redirect()->route('provinces.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
            return redirect()->route('provinces.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Province $province)
    {
        try {
           $province->delete();
            return redirect()->route('provinces.index')->with('success', 'حذف اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
            return redirect()->route('provinces.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }
}
