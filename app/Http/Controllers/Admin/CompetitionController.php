<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Group;
use App\Models\AgeRange;
use App\Models\Examiner;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompetitionRequest;
use Illuminate\Database\Eloquent\Builder;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $competitions = Competition::with(['user'])
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                    ->orWhere('registration_description', 'LIKE', "%{$item}%")
                    ->orWhere('rules_description', 'LIKE', "%{$item}%")
                    ->orWhere('letter_method', 'LIKE', "%{$item}%")
                    ->orWhere('banner', 'LIKE', "%{$item}%")
                    ->orWhereRelation('user', 'first_name', 'LIKE', "%{$item}%")
                    ->orWhereRelation('user', 'last_name', 'LIKE', "%{$item}%");
            })
            ->paginate(10);

        return view('admin.competitions.index', ['competitions' => $competitions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();

        return view('admin.competitions.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $competition = Competition::create([]);

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.competitions.edit', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        $users = User::get();

        $letter_method = $competition->files->where('related_field', 'letter_method')->pluck('path')->first();
        $banner = $competition->files->where('related_field', 'banner')->pluck('path')->first();

        return view('admin.competitions.edit', ['competition' => $competition, 'users' => $users, 'letter_method' => $letter_method, 'banner' => $banner]);
    }

    public function show(Competition $competition)
    {
        $ages = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->with('steps')->get();

        return view('admin.competitions.show', ['competition' => $competition, 'challenges' => $challenges]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CompetitionRequest $request, Competition $competition)
    {
        try {
            $start_time = $request->input('start_time1') . ':' . $request->input('start_time2') . ':00';
            $finish_time = $request->input('finish_time1') . ':' . $request->input('finish_time2') . ':00';

            $competition->update([
                'title' => $request->input('title'),
                'is_active' => $request->input('is_active'),
                'registration_start_time' => Jalalian::fromFormat('Y/m/d', $request->input('registration_start_date'))->toCarbon()->format('Y-m-d') . ' ' . $start_time,
                'registration_finish_time' => Jalalian::fromFormat('Y/m/d', $request->input('registration_finish_date'))->toCarbon()->format('Y-m-d') . ' ' . $finish_time,
                'registration_description' => $request->input('registration_description'),
                'rules_description' => $request->input('rules_description'),
                'creator' => Auth::id(),
            ]);

            if ($request->hasFile('letter_method'))
            {
                $file = $competition->files->where('related_field', 'letter_method')->where('fileable_id', $competition->id)->first();

                if ($file)
                {
                    purge($file->path);
                    $file->delete();
                }

                $letter_method = $request->file('letter_method');
                $storage_dir = '/competition';
                uploadFile($storage_dir, ['letter_method' => $letter_method], ['fileable_id' => $competition->id, 'fileable_type' => Competition::class]);
            }

            if ($request->hasFile('banner'))
            {
                $file = $competition->files->where('related_field', 'banner')->where('fileable_id', $competition->id)->first();

                if ($file)
                {
                    purge($file->path);
                    $file->delete();
                }

                $banner = $request->file('banner');
                $storage_dir = '/competition';
                uploadFile($storage_dir, ['banner' => $banner], ['fileable_id' => $competition->id, 'fileable_type' => Competition::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.groups.create', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Competition $competition)
    {
        try {
            $letter_method = $competition->files->where('related_field', 'letter_method')->where('fileable_id', $competition->id)->first();

            if ($letter_method)
            {
                purge($letter_method->path);
                $letter_method->delete();
            }

            $banner = $competition->files->where('related_field', 'banner')->where('fileable_id', $competition->id)->first();

            if ($banner)
            {
                purge($banner->path);
                $banner->delete();
            }

            $competition->delete();
            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }


    public function result(Competition $competition)
    {
        return view('admin.competitions.result', ['competition' => $competition]);
    }

    public function charts(Competition $competition)
    {
        $chartNumberUsersChallange = $this->chartNumberUsersChallange($competition);

        return view('admin.competitions.charts', ['chartNumberUsersChallange' => $chartNumberUsersChallange]);
    }

    public function chartNumberUsersChallange($competition)
    {
        $groups = Group::where('competition_id', $competition->id)->get();

        foreach ($groups as $group)
        {
            $fields[] = DB::table('field_group')->select('field_id')->where('group_id', $group->id)->first();
        }

        foreach($fields as $field)
        {
            $challenges = Challenge::with('age')->where('field_id', $field->field_id)->groupBy('field_id')->get();

            foreach ($challenges as $challenge)
            {
                $participantCount = Participant::where('challenge_id', $challenge->id)->count();
                $participantIds   = Participant::where('challenge_id', $challenge->id)->pluck('id');
                $examinerCount    = Examiner::whereIn('participant_id', $participantIds)->count();

                $ageRange = $challenge->age->title ?? '';

                $result[] = [
                    'field' => $challenge->field->title,
                    $ageRange .' '. 'ثبت نام کنندگان' => $participantCount,
                    $ageRange .' ' . 'شرکت کنندگان'    => $examinerCount,
                ];
            }
        }

        return json_encode($result);
    }

}
