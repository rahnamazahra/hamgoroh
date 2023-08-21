<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Models\Score;
use App\Models\Examiner;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\EvaluationReferee;
use App\Http\Controllers\Controller;

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

        foreach ($evaluation_referees as $ef)
        {
            $criteria_referee[] = ['criteria_id' => $ef->evaluation->criteria_id, 'criteria_title' => $ef->evaluation->criteria->title, 'referee_id' => $ef->referee_id, 'referee_title' => $ef->referee->fullName()];
        }

        foreach ($step->examiners as $key => $examiner)
        {
            $scores = [];
            $criteria_referee_examiner[$key]['examiner_id'] = $examiner->id;

            foreach ($criteria_referee as $cr)
            {
                if ($score = Score::where('examiner_id', $examiner->id)->where('criteria_id', $cr['criteria_id'])->where('referee_id', $cr['referee_id'])->first())
                {
                    $scores[$cr['criteria_id'].$cr['referee_id']] = $score->score;
                    // array_push($scores, ['criteria_id' => $cr['criteria_id'], 'referee_id' => $cr['referee_id'], 'score' => $score->score]);
                }
                else
                {
                    $scores[$cr['criteria_id'].$cr['referee_id']] = '-';
                    // array_push($scores, ['criteria_referee_id' => $cr['criteria_id'], 'referee_id' => $cr['referee_id'], 'score' => '-']);
                }
            }

            $criteria_referee_examiner[$key]['criteria_referee'] = $scores;
        }
        // dd($criteria_referee_examiner);

        return view('admin.scores.step', ['competition' => $competition, 'step' => $step, 'criteria_referee' => $criteria_referee, 'criteria_referee_examiner' => $criteria_referee_examiner]);
    }

    public function challengeResult(Competition $competition, Challenge $challenge)
    {
        $steps = Step::where('challenge_id', $challenge->id)->get();
        $stepsId = Step::where('challenge_id', $challenge->id)->pluck('id');
        $participants = Examiner::with(['participant', 'participant.user'])->whereIn('step_id', $stepsId)->orderBy('participant_id')->pluck('participant_id')->unique();
        $userScores = [];
        foreach ($steps as $step)
        {
            foreach ($participants as $participant)
            {
                $score = Examiner::where('participant_id', $participant)->where('step_id', $step->id)->first()->score ?? '-';
                $userScores[$participant][] = [
                    'step_id' => $step->id,
                    'participant' => $participant,
                    'score' => $score,
                ];
            }
        }

        $results = [];
        foreach ($userScores as $participant => $scoresArray)
        {
            $results[] = [
                'participant' => $participant,
                'scores' => $scoresArray,
            ];
        }


        foreach ($results as $result)
        {
            $total = 0;
            $sum = 0;
            foreach ($result['scores'] as $score)
            {
                if ($score['score'] != '-')
                {
                    $weight = \App\Models\Step::find($score['step_id'])->weight;
                    $total += (int)$score['score'] * (int)$weight;
                    if ($weight != 1)
                        $sum += $weight;
                }
            }
            $average = ($sum > 0) ? $total / $sum : 0;
            $data = Participant::find($result['participant']);
            $data->score = round($average, 2);
            $data->save();
        }

        Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
        return redirect()->route('admin.dashboard');
    }
}
