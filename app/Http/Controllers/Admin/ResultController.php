<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeRange;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Evaluation;
use App\Models\Examiner;
use App\Models\Group;
use App\Models\Participant;
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
//        dd($results);
        return view('admin.scores.challenge', ['competition' => $competition, 'challenge' => $challenge, 'steps' => $steps, 'results' => $results]);
    }

    public function competition(Competition $competition)
    {
        $participants = Participant::with(['field'])->where('competition_id', $competition->id)->get();

        return view('admin.scores.competition', ['competition' => $competition, 'participants' => $participants]);
    }

    public function test(Competition $competition)
    {
        $groups = Group::with(['fields:title'])->where('competition_id', $competition->id)->get();

        foreach ($groups as $group) {
            $fields[] = DB::table('field_group')->where('group_id', $group->id)->first();
        }

        foreach ($fields as $field) {
            $challenges = Challenge::with('age_range')->where('field_id', $field->field_id)->groupBy('field_id')->get();


            foreach ($challenges as $challenge) {
                $participantCount = Participant::where('challenge_id', $challenge->id)->count();
                $participantIds = Participant::where('challenge_id', $challenge->id)->pluck('id');
                $examinerCount = Examiner::whereIn('participant_id', $participantIds)->count();
                $ageRange = $challenge->age_range->title ?? '';
                $a[] = [
                    'field' => $challenge->field->title,
                    $ageRange . 'ثبت نام کنندگان' => $participantCount,
                ];
                $b[] = [
                    'field' => $challenge->field->title,
                    $ageRange . 'شرکت کنندگان' => $examinerCount,
                ];
            }
        }
        $c = array_merge($a, $b);

        dd($c);
    }
}
