<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use Database\Seeders\ProvinceSeeder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Province::with(['cities']);

        if ($request->query('search_item'))
        {
            $search_item = $request->query('search_item');
            $query->when($search_item, function (Builder $builder) use ($search_item) {
                $builder->where('title', $search_item)
                        ->orWhereRelation('cities', 'title',$search_item);
            });
        }

        $provinces = $query->paginate(10)->withQueryString();

        return view('admin.provinces.index', ['provinces' => $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinceRequest $request)
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
    public function update(ProvinceRequest $request, Province $province)
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
