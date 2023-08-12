<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Exception;
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

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.abouts.index');

        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.abouts.index');
        }
    }

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

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.abouts.index');
        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.abouts.index');
        }
    }

}
