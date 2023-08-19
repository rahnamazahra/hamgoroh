<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationReferee;
use App\Models\Score;
use App\Models\Step;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Step $step)
    {
        $competition = $step->challenge->getCompetition();
        $evaluation_referees = EvaluationReferee::whereRelation('evaluation', 'step_id', $step->id)->with(['evaluation', 'evaluation.criteria', 'referee'])->orderBy('evaluation_id')->get();
        $criteria_referee_examiner = [];
        $scores = [];

        foreach ($evaluation_referees as $ef)
        {
            $criteria_referee[] = ['criteria_id' => $ef->evaluation->criteria_id, 'criteria_title' => $ef->evaluation->criteria->title, 'referee_id' => $ef->referee_id, 'referee_title' => $ef->referee->fullName()];
        }

        $examiners = $step->examiners->pluck('id');

        foreach ($examiners as $key => $examiner)
        {
            $criteria_referee_examiner[]['examiner_id'] = $examiner;
            $scores1 = Score::whereRelation('examiner', 'step_id', $step->id)->where('examiner_id', $examiner)->get();
            $scores2 = [];
            foreach ($scores1 as $score)
            {
                $scores2[] = ['criteria_id' => $score->criteria_id ?? '-', 'referee_id' => $score->referee_id ?? '-', 'score' => $score->score ?? '-'];
            }

            array_push($criteria_referee_examiner, $scores2);
        }
        dd($criteria_referee_examiner);

        // foreach ($step->examiners as $key => $examiner)
        // {
        //     $criteria_referee_examiner[] = $examiner->id;

        //     foreach ($examiner->scores as $score)
        //     {
        //         $scores[] = ['criteria_id' => $score->criteria_id , 'referee_id' => $score->referee_id , 'score' => $score->score];
        //         $ff[] = array_push($criteria_referee_examiner, $scores);
        //     }
        //     $criteria_referee_examiners = array_push($criteria_referee_examiner, $scores);
        //     // foreach ($criteria_referee as $cf)
        //     // {
        //     //     $score = Score::where('examiner_id', $examiner->id)->where('criteria_id', $cf['criteria_id'])->where('referee_id', $cf['referee_id'])->first();
        //     //     $criteria_referee_examiner[$key][] = ['criteria_id' => $score->criteria_id ?? '-', 'referee_id' => $score->referee_id ?? '-', 'score' => $score->score ?? '-'];
        //     // }
        // }

        // dd($ff);

        return view('admin.scores.step', ['competition' => $competition, 'step' => $step, 'criteria_referee' => $criteria_referee, 'criteria_referee_examiner' => $criteria_referee_examiner]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        //
    }
}
