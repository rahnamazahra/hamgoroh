<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Field;
use App\Http\Requests\FieldRequest;
use App\Http\Controllers\Controller;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::paginate(10);

        return view('admin.fields.index', ['fields' => $fields]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request)
    {
        try {
            Field::create([
                'title' => $request->input('title'),
            ]);
        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.field.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FieldRequest $request, Field $field)
    {
        try {
            $field->update([
                'title' => $request->input('title'),
            ]);
        } catch (Throwable $th) {
            // throw $th;
        }

        return redirect()->route('admin.field.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Field $field)
    {
        try {
            $field->delete();
        } catch (Throwable $th) {
        }

        return redirect()->route('admin.field.index');
    }
}
