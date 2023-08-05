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

        return view('admin.competitions.steps.create', ['challenges' => $challenges, 'competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Competition $competition)
    {

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

            $ages       = $competition->ages->pluck('id');
            $challenges = Challenge::whereIn('age_id', $ages)->get();

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');

            return redirect()->route('admin.steps.edit', ['competition' => $competition]);
        }
        catch (Exception $e) {

        }

    }

    public function edit(Competition $competition)
    {
        $ages       = $competition->ages->pluck('id');
        $challenges = Challenge::whereIn('age_id', $ages)->get();

        return view('admin.competitions.steps.edit', ['challenges' => $challenges, 'competition' => $competition]);
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
                $steps      = $challenges->steps();
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

            return redirect()->route('admin.steps.ceate', ['competition' => $competition]);
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
