<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Models\Competition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::paginate(10);

        return view('admin.competitions.index', ['competitions' => $competitions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionRequest $request)
    {
        try {
            Competition::create([
                'title' => $request->input('title'),
                'is_active' => $request->input('is_active'),
                'registration_start_time' => Carbon::parse($request->input('registration_start_time'))->toDateTimeString(),
                'registration_finish_time' => $request->input('registration_finish_time'),
                'registration_description' => $request->input('registration_description'),
                'rules_description' => $request->input('rules_description'),
                'letter_method' => $request->input('letter_method'),
                'banner' => $request->input('banner'),
                'creator' => $request->input('creator'),
            ]);

        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.competitions.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetitionRequest $request, Competition $competition)
    {
        try {
            $competition->update([
                'title' => $request->input('title'),
                'is_active' => $request->input('is_active'),
                'registration_start_time' => $request->input('registration_start_time'),
                'registration_finish_time' => $request->input('registration_finish_time'),
                'registration_description' => $request->input('registration_description'),
                'rules_description' => $request->input('rules_description'),
                'letter_method' => $request->input('letter_method'),
                'banner' => $request->input('banner'),
                'creator' => $request->input('creator'),
            ]);
        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Competition $competition)
    {
        try {
            $competition->delete();
        } catch (Throwable $th) {
        }

        return redirect()->route('admin.competitions.index');
    }
}
