<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Competition;
use App\Models\Field;
use App\Models\Group;
use App\Models\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Throwable;

class StepController extends Controller
{
    public function create(Competition $competition)
    {
        $steps = Step::get();

        return view('admin.competitions.steps.index', ['steps' => $steps, 'competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request, Competition $competition)
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
            $groupData = $request->input('groups');

            foreach ($groupData as $item) {
                $group = Group::create([
                    'title' => $item['title'],
                    'image' => $item['image'],
                    'competition_id' => $competition->id,
                ]);

                $group->fields()->attach($item['fields[']);
            }

            return redirect()->route('admin.competitions.index')->with('success', 'ثبت اطلاعات با موفقیت انجام شد.');


        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (\Exception $e) {
//            return redirect()->route('admin.competitions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }

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
        dd($request->all());
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
