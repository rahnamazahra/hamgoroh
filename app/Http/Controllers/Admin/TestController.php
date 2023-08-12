<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $tests = Test::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.tests.index', ['tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestRequest $request)
    {
        try {
//            dd($request->all());
            $test = Test::create($request->all());
            $test->all_count = $test->easy_count + $test->normal_count + $test->hard_count;
            $test->save();

            return redirect()->route('admin.tests.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
//        catch (\Exception $e) {
//            return redirect()->route('admin.tests.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        return view('admin.tests.edit', ['test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestRequest $request, Test $test)
    {
        try {

            $test->update($request->all());
            $test->all_count = $test->easy_count + $test->normal_count + $test->hard_count;
            $test->save();

            return redirect()->route('admin.tests.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tests.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    public function show(Test $test)
    {
        $testQuestions = TestQuestion::where('test_id', $test->id)->get();
        return view('admin.tests.show', ['test' => $test, 'testQuestions' => $testQuestions]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Test $test)
    {
        try {
            $test->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
