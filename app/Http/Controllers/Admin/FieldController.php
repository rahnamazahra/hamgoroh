<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Models\Field;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $fields = Field::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.fields.index', ['fields' => $fields]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fields.create');
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

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.fields.index');

        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.fields.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        return view('admin.fields.edit', ['field' => $field]);
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

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.fields.index');
        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.fields.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Field $field)
    {
        try {
            $field->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
