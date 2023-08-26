<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Models\User;
use App\Models\Score;
use App\Models\Examiner;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\EvaluationReferee;
use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Evaluation;

class ScoreController extends Controller
{
    public function stepResult(Step $step)
    {
        $examiners   = Examiner::whereHas('scores')->get();
        $denominator = intval(Evaluation::selectRaw('SUM(point) as points_sum')->where('step_id', $step->id)->first()->points_sum);

        foreach ($examiners as $key => $examiner)
        {
            $sum_scores  = 0;

            foreach ($step->evaluations as $evaluation)
            {
                if ($evaluation->refereeing_type == 'average')
                {
                    $scores = Score::selectRaw('COUNT(id) AS count, SUM(score) AS sum')->where('examiner_id', $examiner->id)->where('criteria_id', $evaluation->criteria_id)->first();
                    $score = $scores->sum / $scores->count;
                }
                else
                {
                    $score = Score::where('examiner_id', $examiner->id)->where('criteria_id', $evaluation->criteria_id)->first()->score;
                }

                $sum_scores += $score;
            }

            $final_score = $this->hundredScore($sum_scores, $denominator);
            $examiner->update(['score' => $final_score]);
        }
    }

    public function challengeResult(Challenge $challenge)
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

    public static function hundredScore($score, $from)
    {
        return (100 * $score) / $from;
    }
}
