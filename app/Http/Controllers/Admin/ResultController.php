<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Evaluation;
use App\Models\Examiner;
use App\Models\Group;
use App\Models\Result;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function step(Competition $competition, Step $step)
    {
        $results = Result::with(['examiner', 'examiner.participant', 'examiner.participant.user', 'evaluation',
            'evaluation.criteria', 'referee'])
            ->where('step_id', $step->id)->whereHas('participant', function ($query) use ($competition){
                $query->where('competition_id', $competition->id);
            })
//            ->orderBy('evaluation_id')
            ->paginate(10);

        $results2 = DB::table('results')
            ->select('*', DB::raw('COUNT(*) as count'), DB::raw('AVG(score) as score'))
            ->where('step_id','=', $step->id)
            ->groupBy('participant_id')
            ->get();


//        dd($results2);


        $examiners = Examiner::with(['participant', 'participant.user'])->where('step_id', $step->id)->get();
        $examiners2 = $step->examiners;
//        dd($examiners, $examiners2);
        $evaluations = Evaluation::with(['evaluationReferees', 'evaluationReferees.referee'])
            ->where('step_id', $step->id)->get();

        return view('admin.results.step', ['examiners' => $examiners, 'competition' => $competition, 'step' => $step, 'results' => $results]);
    }

    public function challenge(Competition $competition, Challenge $challenge)
    {
        $results = Result::with(['participant', 'participant.user', 'step'])->whereHas('participant', function ($query) use ($challenge, $competition){
            $query->where('competition_id', $competition->id);
            $query->where('challenge_id', $challenge->id);
        })->paginate(10);

//        dd($results);
//        $steps = Step::with([])->where('challenge_id',$challenge->id)->get();

        return view('admin.results.challenge', ['competition' => $competition, 'challenge' => $challenge, 'results' => $results]);
    }

    public function competition(Competition $competition)
    {
        $results = Result::with(['participant', 'participant.user', 'participant.field'])->whereHas('participant', function ($query) use ($competition){
            $query->where('competition_id', $competition->id);
        })->paginate(10);

//        $groups = Group::with(['fields'])->where('competition_id',$competition->id)->get();

        return view('admin.results.competition', ['competition' => $competition, 'results' => $results]);
    }
}
