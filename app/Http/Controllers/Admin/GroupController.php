<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SelfGroupRequest;
use Exception;
use App\Models\File;
use App\Models\Group;
use App\Models\Field;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Competition $competition, Request $request)
    {
        $item = $request->query('search_item');
        $groups = Group::with(['competition', 'fields'])->where('competition_id', $competition->id)
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                    ->orWhereRelation('competition', 'title', 'LIKE', "%{$item}%")
                    ->orWhereRelation('fields', 'title', 'LIKE', "%{$item}%");
            })
            ->paginate(10);

        return view('admin.groups.index', ['competition' => $competition, 'groups' => $groups]);
    }

    public function create(Competition $competition)
    {
        $fields = Field::get();

        return view('admin.groups.create', ['fields' => $fields, 'competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request, Competition $competition)
    {
        try {
            $groupData = $request->groups;

            foreach ($groupData as $item)
            {
                if ($item['title'])
                {
                    $group = Group::create([
                        'title' => $item['title'],
                        'competition_id' => $competition->id,
                    ]);

                    if ($item['image'])
                    {
                        $file = $group->files->where('related_field', 'image')->first();

                        if ($file)
                        {
                            purge($file->path);
                            $file->delete();
                        }
                        $storage_dir = '/group';
                        uploadFile($storage_dir, ['image' => $item['image']], ['fileable_id' => $group->id, 'fileable_type' => Group::class]);
                    }

                    $group->fields()->attach($item['fields'], ['competition_id' => $competition->id]);
                }
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.challenges.create', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.index');
        }

    }

    public function selfCreate(Competition $competition)
    {
        $fields = Field::get();

        return view('admin.groups.selfCreate', ['fields' => $fields, 'competition' => $competition]);
    }

    public function selfStore(SelfGroupRequest $request, Competition $competition)
    {
        try {
            $group = Group::create([
                'title' => $request->input('title'),
                'competition_id' => $competition->id,
            ]);
            $group->fields()->attach($request->input('fields'), ['competition_id' => $competition->id]);

            $image = $request->file('image');
            $storage_dir = '/groups';
            uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $group->id, 'fileable_type' => Group::class]);

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.groups.index', ['competition' => $competition]);

        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.groups.index', ['competition' => $competition]);
        }
    }

    public function edit(Competition $competition, Group $group)
    {
        $fields = Field::get();

        $image = $group->files->where('fileable_id', $group->id)->where('fileable_type', 'App\Models\Group')->pluck('path')->first();


        return view('admin.groups.edit', ['competition' => $competition, 'fields' => $fields, 'group' => $group, 'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Competition $competition, Group $group)
    {
        try {
//            dd($competition->id);
            $group->update([
                'title' => $request->input('title')
            ]);
            $group->fields()->sync($request->input('fields'), ['competition_id' => 1]);

//            foreach ($request->input('fields') as $field) {
//                $dataToSync = [
//                    'field_id' => $field,
//                    'competition_id' => $competition->id,
//                ];
//                $group->fields()->syncWithoutDetaching($dataToSync);
//            }

                if ($request->hasFile('image')) {
                    $file = $group->files->where('related_field', 'image')
                        ->where('fileable_type', 'App\Models\Group')->where('fileable_id', $group->id)->first();

                    if ($file) {
                        purge($file->path);
                        $file->delete();
                    }
                    $image = $request->file('image');
                    $storage_dir = '/groups';
                    uploadFile($storage_dir, ['image' => $image], ['fileable_id' => $group->id, 'fileable_type' => Group::class]);
                }
//            $items = Group::where('competition_id', $competition->id)->get();
//            foreach ($items as $item)
//            {
//                $file = $item->files->where('related_field','image')->where('fileable_id', $item['id']) //need test
//                    ->where('fileable_type', 'App\Models\Group')->first();
//                if ($file)
//                {
//                    purge($file->path);
//                    $file->delete();
//                }
//
//                $item->find($item['id'])->delete();
//            }
//
//            $data = $request->all();
//
//            foreach ($data['groups'] as $group)
//            {
//                if ($group['title'])
//                {
//                    $groups = Group::create([
//                        'competition_id' => $competition->id,
//                        'title' => $group['title'],
//                    ]);
//
//                    if ($group['image'])
//                    {
//                        $file = File::query()->where('fileable_id', $groups->id)->first();
//
//                        if ($file)
//                        {
//                            purge($file->path);
//                            $file->delete();
//                        }
//                        $storage_dir = '/group';
//                        uploadFile($storage_dir, ['image' => $group['image']], ['fileable_id' => $groups->id, 'fileable_type' => Group::class]);
//                    }
//
//                    $groups->fields()->attach($group['fields'], ['competition_id' => $competition->id]);
//                }
//            }

                Alert('success', 'اطلاعات باموفقیت ثبت شد.');
                return redirect()->route('admin.groups.index', ['competition' => $competition]);
        }catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (Exception $e) {
//            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
//            return redirect()->route('admin.groups.index', ['competition' => $competition]);
//        }

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
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
