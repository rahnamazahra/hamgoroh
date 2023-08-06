<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StepRequest;
use App\Models\Challenge;
use App\Models\Competition;
use App\Models\Step;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return view('admin.competitions.steps.create', ['challenges' => $challenges, 'competition' => $competition]);

        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Competition $competition)
    {
      //  dd($request->all());
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

                foreach ($steps as $item) {
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

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Step $step)
    {
        //
    }
}
