<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $news_category = NewsCategory::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.newsCategories.index', ['news_category' => $news_category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsCategoryRequest $request)
    {
        try {
            NewsCategory::create([
                'title' => $request->input('title'),
            ]);

            return redirect()->route('admin.newsCategories.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $e) {
            return redirect()->route('admin.newsCategories.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.newsCategories.edit', ['newsCategory' => $newsCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsCategoryRequest $request, NewsCategory $newsCategory)
    {
        try {

            $newsCategory->update([
                'title' => $request->input('title'),
            ]);

            return redirect()->route('admin.newsCategories.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.newsCategories.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(NewsCategory $newsCategory)
    {
        try {
            $newsCategory->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
