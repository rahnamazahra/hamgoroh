<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Competition;
use App\Models\Field;
use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Throwable;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $groups = Group::with(['competition', 'fields'])
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                    ->orWhereRelation('competition', 'title', 'LIKE', "%{$item}%")
                    ->orWhereRelation('fields', 'title', 'LIKE', "%{$item}%");
            })
            ->paginate(10);

        return view('admin.groups.index', ['groups' => $groups]);
    }

    public function create()
    {
        $fields = Field::get();
        $competitions = Competition::get();

        return view('admin.groups.create', ['fields' => $fields, 'competitions' => $competitions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        try {
            dd($request->all());
//            $group = Group::create([
//                'title' => $request->input('title'),
//                'image' => $request->input('image'),
//                'competition_id' => $request->input('competition_id'),
//            ]);
//
//            $group->fields()->attach($request->input('fields'));
//
//            return redirect()->route('admin.groups.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
            $groupData = $request->input('kt_docs_repeater_basic');

            foreach ($groupData as $item) {
                $group = Group::create([
                    'title' => $item['title'],
                    'image' => $item['image'],
                    'competition_id' => $item['competition_id'],
                ]);

                $group->fields()->attach($item['fields']);
            }

            return redirect()->route('admin.groups.index')->with('success', 'ثبت اطلاعات با موفقیت انجام شد.');


        } catch (\Exception $e) {
            return redirect()->route('admin.groups.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }

    }

    public function edit(Group $group)
    {
        $fields = Field::get();
        $competitions = Competition::get();

        return view('admin.groups.edit', ['group' => $group, 'fields' => $fields, 'competitions' => $competitions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        try {
            $group->update([
                'title' => $request->input('title'),
                'image' => $request->input('image'),
//                'competition_id' => $request->input('competition_id'),
                'competition_id' => 1,
            ]);
            $group->fields()->sync($request->input('fields'));

            return redirect()->route('admin.groups.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.groups.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Group $group)
    {
        try {
            $group->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
