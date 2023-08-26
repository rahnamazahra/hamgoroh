<?php

namespace App\Http\Controllers\Admin;

use App\Models\Examiner;
use App\Models\Participant;
use App\Models\Step;
use Exception;
use App\Models\AgeRange;
use App\Models\Challenge;
use App\Models\Competition;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;

class ChallengeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Competition $competition)
    {
        return view('admin.challenges.create', ['competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChallengeRequest $request, Competition $competition)
    {
        $gender = $request->input('gender');
        $nationality = $request->input('nationality');

        try {
            foreach ($request->input('age_ranges') as $age)
            {
                AgeRange::create([
                    'competition_id' => $competition->id,
                    'title'          => $age['title'],
                    'from_date'      => Jalalian::fromFormat('Y/m/d', $age['from_date'])->toCarbon(),
                    'to_date'        => Jalalian::fromFormat('Y/m/d', $age['to_date'])->toCarbon(),
                ]);
            }

            $ages = $competition->ages;
            $groups = $competition->groups->pluck('id');
            $fields = DB::table('field_group')->whereIn('group_id', $groups)->groupBy('field_id')->pluck('field_id');

            if ($gender == -1 and $nationality == -1)       // both and both
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '1',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == -1 and $nationality == 0)    // both and native
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '0',
                        ]);
                    }
                }
            }
            elseif ($gender == -1 and $nationality == 1)    //both and foreign
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '1',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == -1 and $nationality == 2)    // both and neither
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '-1',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '-1',
                        ]);
                    }
                }
            }
            elseif ($gender == 0 and $nationality == -1)    // female and both
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == 0 and $nationality == 0)     // female and native
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '0',
                        ]);
                    }
                }
            }
            elseif ($gender == 0 and $nationality == 1)     // female and foreign
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '1',
                        ]);

                    }
                }
            }
            elseif ($gender == 0 and $nationality == 2)     // female and neither
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '0',
                            'nationality' => '-1',
                        ]);
                    }
                }
            }
            elseif ($gender == 1 and $nationality == -1)    // male and both
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == 1 and $nationality == 0)     // male and native
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '0',
                        ]);
                    }
                }
            }
            elseif ($gender == 1 and $nationality == 1)     // male and foreign
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == 1 and $nationality == 2)     // male and neither
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '1',
                            'nationality' => '-1',
                        ]);
                    }
                }
            }
            elseif ($gender == 2 and $nationality == -1)    // neither and both
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '-1',
                            'nationality' => '0',
                        ]);

                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '-1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            elseif ($gender == 2 and $nationality == 0)     // neither and native
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '-1',
                            'nationality' => '0',
                        ]);
                    }
                }
            }
            elseif ($gender == 2 and $nationality == 1)     // neither and foreign
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '-1',
                            'nationality' => '1',
                        ]);
                    }
                }
            }
            else                                            // neither and neither
            {
                foreach ($fields as $field)
                {
                    foreach ($ages as $age)
                    {
                        Challenge::create([
                            'field_id' => $field,
                            'age_id' => $age->id,
                            'gender' => '-1',
                            'nationality' => '-1',
                        ]);
                    }
                }
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.challenges.edit', ['competition' => $competition]);
        }
        catch (Exception $exception)  {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.challenges.create', ['competition' => $competition]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        $fields = DB::table('field_group')->where('competition_id', $competition->id)->groupBy('field_id')->get(['field_id']);
        $challenges = Challenge::whereRelation('age', 'competition_id', $competition->id)->with(['field', 'age'])->get();

        return view('admin.challenges.edit', ['competition' => $competition, 'fields' => $fields, 'challenges' => $challenges]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChallengeRequest $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Challenge $challenge)
    {
        //
    }

    public function createInfo(Competition $competition, Challenge $challenge)
    {
       return view('admin.challenges.info', ['competition' => $competition, 'challenge' => $challenge]);
    }

    public function storeInfo(Request $request, Competition $competition, Challenge $challenge)
    {
        try {

            $challenge->update(['description' => $request->input('description')]);

            if($request->hasFile('file'))
            {
                $file        = $request->file('file');
                $storage_dir = '/challenge';

                uploadFile($storage_dir, ['file' => $file], ['fileable_id' => $challenge->id, 'fileable_type' => Challenge::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition->id]);
        }
        catch (Exception $exception) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.challenges.info.create', ['competition' => $competition->id, 'challenge' => $challenge]);
        }
    }

    public function createSchedule(Competition $competition, Challenge $challenge)
    {
        return view('admin.challenges.schedule', ['competition' => $competition, 'challenge' => $challenge]);
    }

    public function storeSchedule(Request $request, Competition $competition, Challenge $challenge)
    {
        try {

            $start_time = $request->input('start_time1') . ':' . $request->input('start_time2') . ':00';
            $finish_time = $request->input('finish_time1') . ':' . $request->input('finish_time2') . ':00';

            $challenge->update([
                'result_start_time' => Jalalian::fromFormat('Y/m/d', $request->input('result_start_time'))->toCarbon()->format('Y-m-d') . ' ' . $start_time,
                'result_finish_time' => Jalalian::fromFormat('Y/m/d', $request->input('result_finish_time'))->toCarbon()->format('Y-m-d') . ' ' . $finish_time,
            ]);

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition->id]);
        }
        catch (Exception $e)
        {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition->id]);
        }
    }

    public function result(Competition $competition, Challenge $challenge)
    {
        $steps = Step::where('challenge_id', $challenge->id)->get();
        $stepsId = Step::where('challenge_id', $challenge->id)->pluck('id');
        $participants = Examiner::with(['participant', 'participant.user'])->whereIn('step_id', $stepsId)->orderBy('participant_id')->pluck('participant_id')->unique();

        $userScores = [];
        foreach ($steps as $step) {
            foreach ($participants as $participant) {
                $score = Examiner::where('participant_id', $participant)->where('step_id', $step->id)->first()->score ?? '-';
                $userScores[$participant][] = [
                    'step_id' => $step->id,
                    'participant' => $participant,
                    'score' => $score,
                ];
            }
        }

        $results = [];
        foreach ($userScores as $participant => $scoresArray) {
            $total_score = Participant::find($participant)->score;
            $results[] = [
                'participant' => $participant,
                'scores' => $scoresArray,
                'total_score' => $total_score,
            ];
        }
        return view('admin.challenges.result', ['competition' => $competition, 'challenge' => $challenge, 'steps' => $steps, 'results' => $results]);
    }

}
