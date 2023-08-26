<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeRange;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Evaluation;
use App\Models\Examiner;
use App\Models\Score;
use App\Models\Step;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefereeController extends Controller
{
    public function index()
    {
//        $referee = Auth::user();
        $referee = User::find(5);
        $evaluation_ids = DB::table('evaluation_referees')->where('referee_id', $referee->id)->pluck('evaluation_id');
        $step_ids = Evaluation::whereIn('id', $evaluation_ids)->pluck('step_id')->unique();
        $challenge_ids = Step::whereIn('id', $step_ids)->pluck('challenge_id')->unique();
        $age_ids = Challenge::whereIn('id', $challenge_ids)->pluck('age_id')->unique();
        $competition_ids = AgeRange::whereIn('id', $age_ids)->pluck('competition_id')->unique();

        foreach ($competition_ids as $competition_id){
            $ageIds = Competition::find($competition_id)->ages->pluck('id');
            $challengeIds = Challenge::whereIn('age_id', $ageIds)->pluck('id');
            $stepIds = Step::whereIn('challenge_id', $challengeIds)->pluck('id');
            $commonStepIds = array_intersect($stepIds->toArray(), $step_ids->toArray());
            $challenges = Step::whereIn('id', $commonStepIds)->pluck('challenge_id')->unique();
            $results[] = [
                'competition_id' => $competition_id,
//                'challenges' => $challenges->toArray(),
                'steps' => $commonStepIds,
            ];
        }
//        dd($results);
        return view('admin.referees.index', ['referee' => $referee, 'results' => $results]);
    }

    public function create(Step $step, $examiner=null)
    {
        $referee = User::find(5);
//        $evaluation_ids = DB::table('evaluation_referees')->where('referee_id', $referee->id)->pluck('evaluation_id');
//        $step_ids = Evaluation::whereIn('id', $evaluation_ids)->pluck('step_id')->unique();
//        $challenge = $step->challenge;
//        $stepIds = $challenge->steps->pluck('id');
//        $commonStepIds = array_intersect($stepIds->toArray(), $step_ids->toArray());
//        $examinerIds = Examiner::whereIn('step_id', $commonStepIds)->pluck('id');

        $examinerIds = $step->examiners->pluck('id');
        $nomre_dar = Score::where('referee_id', $referee->id)->whereIn('examiner_id', $examinerIds)->pluck('examiner_id')->unique();
        $nomre_nadar = array_diff($examinerIds->toArray(), $nomre_dar->toArray());
        $evaluationIds = DB::table('evaluation_referees')->where('referee_id', $referee->id)->pluck('evaluation_id');
        $criterias = Evaluation::where('step_id', $step->id)->whereIn('id', $evaluationIds)->pluck('criteria_id');
        $last_examiners = [];
        foreach ($nomre_dar as $examinerId) {
            $score = Score::where('referee_id', $referee->id)
                ->where('examiner_id', $examinerId)->get();
            $last_examiners[] = [
                'examiner_id' => $examinerId,
                'scores' => $score->toArray(),
            ];
        }
        return view('admin.referees.create', ['step' => $step, 'referee' => $referee, 'nomre_nadar' => $nomre_nadar, 'criterias' => $criterias, 'last_examiners' => $last_examiners, 'examiner' => $examiner]);
    }

    public function store(Request $request, Step $step)
    {
        try {
//            $referee = Auth::user();
            $referee = User::find(5);
            for ($i=0; $i < count($request->score); $i++){
                Score::create([
                    'examiner_id' => $request->examiner_id,
                    'criteria_id' => $request->criteria_id[$i],
                    'referee_id' => $referee->id,
                    'score' => $request->score[$i]
                ]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.referee.create', ['step' => $step->id]);
        }catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function show(Step $step)
    {
//        $referee = Auth::user();
        $referee = User::find(5);
        $examinerIds = Examiner::where('step_id', $step->id)->pluck('id');
        $nomre_dar = Score::where('referee_id', $referee->id)->whereIn('examiner_id', $examinerIds)->pluck('examiner_id')->unique();
        $nomre_nadar = array_diff($examinerIds->toArray(), $nomre_dar->toArray());

        $results = [];

        foreach ($nomre_dar as $examinerId) {
            $score = Score::where('referee_id', $referee->id)
                ->where('examiner_id', $examinerId)->get();

            $results[] = [
                'examiner_id' => $examinerId,
                'scores' => $score->toArray(),
            ];
        }

        foreach ($nomre_nadar as $examinerId) {
            $results[] = [
                'examiner_id' => $examinerId,
                'scores' => null
            ];
        }

//        dd($results);
        return view('admin.referees.show', ['referee' => $referee, 'step' => $step, 'results' => $results]);
    }
}
