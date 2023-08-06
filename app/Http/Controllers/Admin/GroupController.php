<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Competition;
use App\Models\Field;
use App\Models\File;
use App\Models\Group;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    public function create(Competition $competition)
    {
        $fields = Field::get();
//        $competitions = Competition::get();

        return view('admin.competitions.groups.index', ['fields' => $fields, 'competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request, Competition $competition)
    {
        try {

            $groupData = $request->groups;

            foreach ($groupData as $item) {
                if ($item['title']) {
                    $group = Group::create([
                        'title' => $item['title'],
                        'competition_id' => $competition->id,
                    ]);
                    if ($item['image']) {
//                        dd('ll');
                        $file = $group->files->where('related_field', 'image')->first();

                        if ($file) {
                            purge($file->path);
                            $file->delete();
                        }
                        $storage_dir = '/group';
                        uploadFile($storage_dir, ['image' => $item['image']], ['fileable_id' => $group->id, 'fileable_type' => Group::class]);
                    }

                    $group->fields()->attach($item['fields'], ['competition_id' => $competition->id]);
                }
            }

            return redirect()->route('admin.challenges.create', ['competition' => $competition])->with('success', 'ثبت اطلاعات با موفقیت انجام شد.');


        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (\Exception $e) {
//            return redirect()->route('admin.competitions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }

    }

    public function edit(Competition $competition)
    {
        $fields = Field::get();
//        $competitions = Competition::get();

        return view('admin.groups.edit', ['fields' => $fields, 'competition' => $competition]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Competition $competition)
    {
//        dd($request->all());
        try {
            $items = Group::where('competition_id', $competition->id)->get();
            foreach ($items as $item) {
                $file = $item->files->where('related_field','image')->where('fileable_id', $item['id']) //need test
                    ->where('fileable_type', 'App\Models\Group')->first();
                if ($file){
                    purge($file->path);
                    $file->delete();
                }

                $item->find($item['id'])->delete();
            }
            $data = $request->all();
            foreach ($data['groups'] as $group) {
                if ($group['title']) {
                    $groups = new Group();
                    $groups->competition_id = $competition->id;
                    $groups->title = $group['title'];
                    $groups->save();

                    if ($group['image']) {
                        $file = File::query()->where('fileable_id', $groups->id)->first();

                        if ($file) {
                            purge($file->path);
                            $file->delete();
                        }
                        $storage_dir = '/group';
                        uploadFile($storage_dir, ['image' => $group['image']], ['fileable_id' => $groups->id, 'fileable_type' => Group::class]);
                    }

                    $groups->fields()->attach($group['fields'], ['competition_id' => $competition->id]);
                }
            }

            return redirect()->route('admin.challenges.create', ['competition' => $competition])->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (\Exception $e) {
//            return redirect()->route('admin.groups.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
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
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
