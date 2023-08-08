<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Challenge;
use App\Models\Technique;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechniqueController extends Controller
{
    public function index(Challenge $challenge)
    {
        $techniques = Technique::where('challenge_id', $challenge->id)->paginate(10);
        return view('admin.technique.index', ['techniques' => $techniques, 'challenge' => $challenge]);
    }

    public function create(Challenge $challenge)
    {
        return view('admin.technique.create', ['challenge' => $challenge]);
    }

    public function store(Request $request, Challenge $challenge)
    {
        try {

            $technique = Technique::create([
                'challenge_id' => $challenge->id,
                'title'        => $request->input('title'),
                'description'  => $request->input('description')
            ]);

            if($request->hasFile('file'))
            {
                $file        = $request->file('file');
                $storage_dir = '/technique';

                uploadFile($storage_dir, ['file' => $file], ['fileable_id' => $technique->id, 'fileable_type' => Technique::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');

            return redirect()->route('admin.techniques.index', ['challenge' => $challenge->id]);
        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.techniques.create', ['challenge' => $challenge->id]);
        }
    }

    public function edit(Technique $technique, Challenge $challenge)
    {
        return view('admin.technique.edit', ['technique' => $technique, 'challenge' => $challenge]);
    }

    public function update(Request $request, Technique $technique, Challenge $challenge)
    {
        try {

            $technique->update([
                'challenge_id' => $challenge->id,
                'title'        => $request->input('title'),
                'description'  => $request->input('description')
            ]);

            if($request->hasFile('file'))
            {
                $file = $technique->files->where('related_field','file')->first();

                if($file)
                {
                    purge($file->path);
                    $file->delete();
                }

                $file        = $request->file('file');
                $storage_dir = '/technique';

                uploadFile($storage_dir, ['file' => $file], ['fileable_id' => $challenge->id, 'fileable_type' => Technique::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');

            return redirect()->route('admin.techniques.index', ['challenge' => $challenge->id]);
        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.techniques.edit', ['technique' => $technique->id, 'challenge' => $challenge->id]);
        }
    }

    public function delete(Technique $technique)
    {
        try {

            $technique->delete();

            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }

}
