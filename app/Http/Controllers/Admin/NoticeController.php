<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $notices = Notice::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.notices.index', ['notices' => $notices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoticeRequest $request)
    {
        try {
            dd(';;');
            $selectedReferees = $request->input('selected_referees', []);
            $selectedProvincials = $request->input('selected_provincials', []);
            $selectedGenerals = $request->input('selected_generals', []);
            $selectedUsers = array_merge($selectedReferees, $selectedProvincials, $selectedGenerals);
            Notice::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'is_sent_users' => $request->input('is_sent_users') ?? 0,
                'is_sent_referees' => $request->input('is_sent_referees') ?? 0,
                'is_sent_generals' => $request->input('is_sent_generals') ?? 0,
                'is_sent_provincials' => $request->input('is_sent_provincials') ?? 0,
                'selected_users' => json_encode($selectedUsers),
            ]);

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.notices.index');
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.notices.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', ['notice' => $notice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        try {
            $notice->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.notices.index');
        }
         catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.notices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Notice $notice)
    {
        try {
            $notice->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
