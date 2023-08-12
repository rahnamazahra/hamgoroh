<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Role;
use App\Models\Step;
use App\Models\User;
use App\Models\Criteria;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EvaluationReferee;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    public function index(Step $step)
    {
        $evaluations = Evaluation::where('step_id', $step->id)->paginate(10);

        return view('admin.evaluations.index', ['evaluations' => $evaluations, 'step' => $step]);
    }

    public function create(Step $step)
    {
        $criterias = Criteria::get();
        $referees  = User::whereHas('roles', function ($query) {
                        $query->where('slug', 'referee');
                    })->get();

        return view('admin.evaluations.create', ['step' => $step, 'criterias' => $criterias, 'referees' => $referees]);
    }

    public function store(Request $request, Step $step)
    {
        // dd($request->all());
        try {

            $evaluation = Evaluation::create([
                'step_id'          => $step->id,
                'criteria_id'      => $request->input('criteria_id'),
                'point'            => $request->input('point'),
                'refereeing_type'  => $request->input('refereeing_type'),
            ]);

            $referees = $request->input('referees');

            foreach($referees as $referee)
            {
                EvaluationReferee::create([
                    'evaluation_id' => $evaluation->id,
                    'referee_id'    => $referee,
                ]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');

            return redirect()->route('admin.evaluations.index', ['step' => $step->id]);
        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.evaluations.create', ['step' => $step->id]);
        }
    }

    public function edit(evaluation $evaluation, Step $step)
    {
        $criterias = Criteria::get();
        $referees  = Role::find(5)->users;

        return view('admin.evaluations.edit', ['evaluation' => $evaluation, 'step' => $step, 'criterias' => $criterias, 'referees' => $referees]);
    }

    public function update(Request $request, evaluation $evaluation, Step $step)
    {
        try {

            $evaluation->update([
                'step_id'          => $step->id,
                'criteria_id'      => $request->input('criteria_id'),
                'point'            => $request->input('point'),
                'refereeing_type'  => $request->input('refereeing_type'),
            ]);

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');

            return redirect()->route('admin.evaluations.index', ['step' => $step->id]);
        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.evaluations.edit', ['evaluation' => $evaluation->id, 'step' => $step->id]);
        }
    }

    public function delete(Evaluation $evaluation)
    {
        try {

            $evaluation->delete();

            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
