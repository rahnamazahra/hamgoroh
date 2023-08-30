<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SelfStepRequest;
use Exception;
use App\Models\Step;
use App\Models\Score;
use App\Models\Challenge;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\EvaluationReferee;
use App\Http\Requests\StepRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StepController extends Controller
{
    public function create(Competition $competition)
    {
        $ages       = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->withCount('steps')->get();
        // $steps      = $challenges->sum('steps_count');


        // if($steps > 0)
        // {

        //    $groups = Step::whereIn('id', function ($query) {
        //         $query->selectRaw('MIN(id)')
        //             ->from('steps')
        //             ->groupBy('group');
        //     })
        //     ->with('challenge.age')
        //     ->pluck('group');


        //     return view('admin.competitions.steps.edit', ['groups' => $groups, 'challenges' => $challenges, 'competition' => $competition]);
        // }
        // else
        // {
        return view('admin.steps.create', ['challenges' => $challenges, 'competition' => $competition]);
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Competition $competition)
    {
        try {
            foreach ($request->input('groups') as $groupId => $groupValue)
            {
                foreach($groupValue['challenges'] as $challengeId)
                {
                    foreach($groupValue['steps'] as $step)
                    {
                        Step::create([
                            'challenge_id' => $challengeId,
                            'title'        => $step['title'],
                            'weight'       => $step['weight'],
                            'level'        => $step['level'],
                            'type'         => $step['type'],
                            'group'        => $groupId,
                        ]);
                    }
                }
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.steps.create', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.steps.create', ['competition' => $competition->id]);
        }

    }

    public function selfCreate(Competition $competition, Challenge $challenge)
    {
        return view('admin.steps.selfCreate', ['competition' => $competition, 'challenge' => $challenge]);
    }

    public function selfStore(SelfStepRequest $request, Competition $competition)
    {
        try {
            Step::create($request->all());

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition->id]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competition $competition)
    {
        $ages       = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->get();

        foreach($challenges as $challenge)
        {
            $steps = $challenge->steps();

            foreach ($steps as $item)
            {
                $item->find($item['id'])->delete();
            }
        }

        try {
            foreach ($request->input('groups') as $group)
            {
                foreach($group['challenges'] as $challenge)
                {
                    foreach($group['steps'] as $step)
                    {
                        Step::create([
                            'challenge_id' => $challenge,
                            'title'        => $step['title'],
                            'weight'       => $step['weight'],
                            'level'        => $step['level'],
                            'type'         => $step['type']
                        ]);
                    }
                }
            }

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.steps.create', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.steps.create', ['competition' => $competition]);
        }

    }

    public function selfEdit(Competition $competition, Step $step)
    {
        return view('admin.steps.selfEdit', ['competition' => $competition, 'step' => $step]);

    }

    public function selfUpdate(SelfStepRequest $request, Competition $competition, Step $step)
    {
        try {
            $step->update($request->all());

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.competitions.show', ['competition' => $competition->id]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(Step $step)
    {
        try {
            $step->delete();
            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }


    public function result($step)
    {
        $step = Step::find($step)->with(['challenge', 'evaluations', 'evaluations.evaluationReferees']);
        $competition = $step->challenge->getCompetition();
        $evaluation_referees = EvaluationReferee::whereRelation('evaluation', 'step_id', $step->id)->with(['evaluation', 'evaluation.criteria', 'referee'])->orderBy('evaluation_id')->get();
        $criteria_referee_examiner = [];

        // foreach ($evaluation_referees as $ef)
        // {
        //     $criteria_referee[] = ['criteria_id' => $ef->evaluation->criteria_id, 'criteria_title' => $ef->evaluation->criteria->title, 'referee_id' => $ef->referee_id, 'referee_title' => $ef->referee->fullName()];
        // }

        // foreach ($step->examiners as $key => $examiner)
        // {
        //     $scores = [];
        //     $criteria_referee_examiner[$key]['examiner_id'] = $examiner->id;

        //     foreach ($criteria_referee as $cr)
        //     {
        //         if ($score = Score::where('examiner_id', $examiner->id)->where('criteria_id', $cr['criteria_id'])->where('referee_id', $cr['referee_id'])->first())
        //         {
        //             $scores[$cr['criteria_id'].$cr['referee_id']] = $score->score;
        //             // array_push($scores, ['criteria_id' => $cr['criteria_id'], 'referee_id' => $cr['referee_id'], 'score' => $score->score]);
        //         }
        //         else
        //         {
        //             $scores[$cr['criteria_id'].$cr['referee_id']] = '-';
        //             // array_push($scores, ['criteria_referee_id' => $cr['criteria_id'], 'referee_id' => $cr['referee_id'], 'score' => '-']);
        //         }
        //     }

        //     $criteria_referee_examiner[$key]['criteria_referee'] = $scores;
        //     $criteria_referee_examiner[$key]['score'] = $examiner->score;
        // }

        // foreach ($step->evaluations as $index => $evaluation)
        // {
        //     foreach ($evaluation->evaluationReferees as $evaluation_referee)
        //     {
        //         $criterias_referees[]['criteria_referee'] = ['criteria_id' => $evaluation_referee->evaluation->criteria_id, 'criteria_title' => $evaluation_referee->evaluation->criteria->title, 'referee_id' => $evaluation_referee->referee_id, 'referee_title' => $evaluation_referee->referee->fullName()];
        //     }

        //     if ($evaluation->refereeing_type == 'average')
        //     {
        //         $criterias_referees[]['criteria_average'] = ['criteria_id' => $evaluation_referee->evaluation->criteria_id, 'criteria_title' => $evaluation_referee->evaluation->criteria->title];
        //     }
        // }

        // foreach ($step->examiners as $key => $examiner)
        // {
        //     $scores = [];
        //     $criteria_referee_examiner[$key]['examiner_id'] = $examiner->id;

        //     foreach ($criterias_referees as $cr)
        //     {
        //         if (array_key_exists('criteria_referee', $cr))  // Criterias and Referees
        //         {
        //             if ($score = Score::where('examiner_id', $examiner->id)->where('criteria_id', $cr['criteria_referee']['criteria_id'])->where('referee_id', $cr['criteria_referee']['referee_id'])->first())
        //             {
        //                 $scores[$cr['criteria_referee']['criteria_id'].$cr['criteria_referee']['referee_id']] = $score->score;
        //             }
        //             else
        //             {
        //                 $scores[$cr['criteria_referee']['criteria_id'].$cr['criteria_referee']['referee_id']] = '-';
        //             }
        //         }
        //         else    // Average of criterias
        //         {
        //             if ($average_scores = Score::selectRaw('COUNT(id) AS count, SUM(score) AS sum')->where('examiner_id', $examiner->id)->where('criteria_id', $evaluation->criteria_id)->first())
        //             {
        //                 dd($average_scores);
        //                 $scores['average_'.$cr['criteria_average']['criteria_id']] = $average_scores->sum / $average_scores->count;
        //             }
        //             else
        //             {
        //                 $scores['average_'.$cr['criteria_average']['criteria_id']] = '-';
        //             }
        //         }
        //     }

        //     $criteria_referee_examiner[$key]['criteria_referee'] = $scores;
        //     $criteria_referee_examiner[$key]['score'] = $examiner->score;
        // }
        // dd($criteria_referee_examiner);

        foreach ($step->evaluations as $key => $value) {
            # code...
        }


        return view('admin.steps.result', ['competition' => $competition, 'step' => $step, 'criterias_referees' => $criterias_referees, 'criteria_referee_examiner' => $criteria_referee_examiner]);
    }
}
