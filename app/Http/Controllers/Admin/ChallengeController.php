<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\AgeRange;
use App\Models\Challenge;
use App\Models\Competition;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Competition $competition)
    {
        return view('admin.competitions.challenges.create', ['competition' => $competition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChallengeRequest $request, Competition $competition)
    {
        // dd($request->input('age_ranges'));
        try {
            foreach ($request->input('age_ranges') as $age)
            {
                AgeRange::create([
                    'competition_id' => $competition->id,
                    'title' => $age->title,
                    'from_date' => Jalalian::fromFormat('Y/m/d', $age->from_date)->toCarbon(),
                    'to_date' => Jalalian::fromFormat('Y/m/d', $age->to_date)->toCarbon(),
                ]);
            }

            //


        }
        catch (Exception $e) {
            return redirect()->route('admin.challenges.create')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
        return view('admin.competitions.challenges.edit', ['competition' => $competition]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChallengeRequest $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
