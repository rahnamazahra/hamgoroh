<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Exception;
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

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.settings.index');

        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.settings.index');
        }
    }

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

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.settings.index');
        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.settings.index');
        }
    }
}
