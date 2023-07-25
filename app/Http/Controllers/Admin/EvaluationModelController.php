<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationModel;
use Illuminate\Http\Request;

class EvaluationModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluation_models = EvaluationModel::get();

        return view('admin.evaluation_models.index', ['evaluation_models' => $evaluation_models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluationModel $evaluationModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluationModel $evaluationModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluationModel $evaluationModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluationModel $evaluationModel)
    {
        //
    }
}
