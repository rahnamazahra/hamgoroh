<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::query()->first();

        return view('admin.abouts.index', ['about' => $about]);
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        return view('admin.abouts.create');
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        try {
            $about = About::create([
                'body' => $request->input('body'),
                'preview' => $request->input('preview'),
            ]);

            if ($request->hasFile('image')){
                $file = $about->files->where('related_field','image')->first();

                if ($file){
                    purge($file->path);
                    $file->delete();
                }
                $image = $request->file('image');
                $storage_dir = '/about';
                uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $about->id, 'fileable_type' => About::class]);
            }

            return redirect()->route('admin.abouts.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $e) {
            return redirect()->route('admin.abouts.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit(About $about)
//    {
//        return view('admin.abouts.edit', ['about' => $about]);
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        try {

            $about->update([
                'body' => $request->input('body'),
                'preview' => $request->input('preview'),
            ]);

            if ($request->hasFile('image')){
                $file = $about->files->where('related_field','image')
                    ->where('fileable_type', 'App\Models\About')->first();

                if ($file){
                    purge($file->path);
                    $file->delete();
                }
                $image = $request->file('image');
                $storage_dir = '/about';
                uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $about->id, 'fileable_type' => About::class]);
            }

            return redirect()->route('admin.abouts.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.abouts.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(About $about)
    {
        try {
            $about->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
