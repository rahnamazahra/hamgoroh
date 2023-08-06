<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::query()->first();

        return view('admin.settings.index', ['setting' => $setting]);
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
    public function store(SettingRequest $request)
    {
        try {
            $setting = Setting::create([
                'title' => $request->input('title'),
            ]);

            if ($request->hasFile('logo')){
                $file = $setting->files->where('related_field','logo')->first();

                if ($file){
                    purge($file->path);
                    $file->delete();
                }
                $logo = $request->file('logo');
                $storage_dir = '/setting';
                uploadFile($storage_dir, ['logo' => $logo], ['fileable_id' => $setting->id, 'fileable_type' => Setting::class]);
            }

            return redirect()->route('admin.settings.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
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
    public function update(SettingRequest $request, Setting $setting)
    {
        try {

            $setting->update([
                'title' => $request->input('title'),
            ]);

            if ($request->hasFile('logo')){
                $file = $setting->files->where('related_field','logo')->where('fileable_type', 'App\Models\Setting')->first();

                if ($file){
                    purge($file->path);
                    $file->delete();
                }
                $logo = $request->file('logo');
                $storage_dir = '/setting';
                uploadFile($storage_dir, ['logo' => $logo], ['fileable_id' => $setting->id, 'fileable_type' => Setting::class]);
            }

            return redirect()->route('admin.settings.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Setting $setting)
    {
        try {
            $setting->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
