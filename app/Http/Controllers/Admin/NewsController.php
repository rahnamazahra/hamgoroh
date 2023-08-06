<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $news = News::with(['categories'])
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                    ->orWhere('sub_title', 'LIKE', "%{$item}%")
                    ->orWhere('preview', 'LIKE', "%{$item}%")
                    ->orWhereRelation('categories', 'title', 'LIKE', "%{$item}%");
            })
            ->paginate(10);

        return view('admin.news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news_category = NewsCategory::get();

        return view('admin.news.create', ['news_category' => $news_category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
//            dd($request->all());
            $news = News::create([
                'title' => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
                'preview' => $request->input('preview'),
                'body' => $request->input('body'),
                'is_published' => $request->input('is_published'),
            ]);
            $news->categories()->attach($request->input('news_category'));

            if ($request->hasFile('image')){

                $image = $request->file('image');
                $storage_dir = '/news';
                uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $news->id, 'fileable_type' => News::class]);
            }

            return redirect()->route('admin.news.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (\Exception $e) {
//            return redirect()->route('admin.news.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news_category = NewsCategory::get();

        $image = $news->files->where('fileable_id', $news->id)->where('fileable_type', 'App\Models\News')->pluck('path')->first();

        return view('admin.news.edit', ['news' => $news, 'news_category' => $news_category, 'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        try {
            $news->update([
                'title' => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
                'preview' => $request->input('preview'),
                'body' => $request->input('body'),
                'is_published' => $request->input('is_published'),
            ]);
            $news->categories()->sync($request->input('news_category'));

            if ($request->hasFile('image')){
                $file = $news->files->where('related_field','image')
                    ->where('fileable_type', 'App\Models\News')->where('fileable_id', $news->id)->first();

                if ($file){
                    purge($file->path);
                    $file->delete();
                }
                $image = $request->file('image');
                $storage_dir = '/news';
                uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $news->id, 'fileable_type' => News::class]);
            }

            return redirect()->route('admin.news.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        }catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
// catch (\Exception $e) {
//            return redirect()->route('admin.competitions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }

    }

    public function show(News $news)
    {
        return view('admin.news.show', ['news' => $news]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(News $news)
    {
        try {
            $file = $news->files->where('related_field','image')
                ->where('fileable_type', 'App\Models\News')->where('fileable_id', $news->id)->first();

            if ($file){
                purge($file->path);
                $file->delete();
            }

            $news->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
