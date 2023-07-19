<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Throwable;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::paginate(10);

        return view('admin.groups.index', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request)
    {
        try {
            Group::create([
                'title' => $request->input('title'),
                'competition_id' => $request->input('competition_id'),
            ]);

        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.groups.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        try {
            $group->update([
                'title' => $request->input('title'),
                'competition_id' => $request->input('competition_id'),
            ]);
        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Group $group)
    {
        try {
            $group->delete();
        } catch (Throwable $th) {
        }

        return redirect()->route('admin.groups.index');
    }
}
