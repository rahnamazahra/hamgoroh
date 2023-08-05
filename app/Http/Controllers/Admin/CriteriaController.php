<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CriteriaRequest;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $criteria = Criteria::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.criteria.index', ['criteria' => $criteria]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriteriaRequest $request)
    {
        try {
            Criteria::create($request->all());

            return redirect()->route('admin.criteria.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $e) {
            return redirect()->route('admin.criteria.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return view('admin.criteria.edit', ['criteria' => $criteria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CriteriaRequest $request, Criteria $criteria)
    {
        try {

            $criteria->update($request->all());

            return redirect()->route('admin.criteria.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.criteria.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Criteria $criteria)
    {
        try {
            $criteria->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
