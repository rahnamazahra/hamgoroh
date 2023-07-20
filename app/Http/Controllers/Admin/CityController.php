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
        $query = trim($request->get('query'));
        if ($request->ajax()) {
            $data = City::where('title', 'LIKE', $query . '%')->limit(15)->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->title . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'یافت نشد' . '</li>';
            }
            return $output;
        }
        $cities      = City::where('title', 'LIKE', '%' . $query . '%')->paginate(15);
        $provinces   = Province::all();
        return view('admin.cities.index', ['provinces' => $provinces, 'cities' => $cities]);
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
        catch (Throwable $th) {
            return redirect()->route('admin.cities.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    public function update(CityRequest $request, City $city)
    {
        try {
            $city->update($request->all());
            return redirect()->route('admin.cities.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
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
            return redirect()->route('admin.cities.index')->with('success', 'حذف اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
            return redirect()->route('admin.cities.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }
}
