<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StepRequest;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Step;
use Exception;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function create(Competition $competition)
    {
        $ages       = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->get();

        return view('admin.competitions.steps.index', ['challenges' => $challenges, 'competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Competition $competition)
    {
 dd($request->all());

        try {
                foreach ($request->input('challenge') as $key => $challenge)
                {
                    foreach($challenge['steps'] as $step)
                    {

                        Step::create([
                            'challenge_id' => $challenge->id,
                            'title' => $step['title'],
                            'weight' => $step['weight'],
                            'level' => $step['level'],
                            'type' => $step['type']
                        ]);

                    }
                }
        }
        catch (Exception $e) {

        }

    }

    public function edit(Competition $competition)
    {
        $ages       = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->get();

        return view('admin.competitions.steps.index', ['challenges' => $challenges, 'competition' => $competition]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StepRequest $request, Competition $competition)
    {
        try {


        }
        catch (Exception $e) {

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
        } catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
