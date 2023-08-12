<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestQuestionRequest;
use App\Models\Test;
use App\Models\TestQuestion;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $testQuestions = TestQuestion::when($item, function (Builder $builder) use ($item) {
            $builder->where('title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.testQuestions.index', ['testQuestions' => $testQuestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Test $test)
    {
        $testQuestions = TestQuestion::where('test_id', $test->id)->get();
        return view('admin.testQuestions.create', ['test' => $test, 'testQuestions' => $testQuestions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestQuestionRequest $request, Test $test)
    {
        try {
            TestQuestion::create([
                'test_id' => $test->id,
                'title' => $request->input('title'),
                'correct_answer' => $request->input('correct_answer'),
                'ancillary_answer' => json_encode($request->input('ancillary_answer')),
                'option_one' => $request->input('option_one'),
                'option_two' => $request->input('option_two'),
                'option_three' => $request->input('option_three'),
                'option_four' => $request->input('option_four'),
                'level' => $request->input('level'),
            ]);

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.testQuestions.create', ['test' => $test]);

        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.testQuestions.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test, TestQuestion $testQuestion)
    {
        return view('admin.testQuestions.edit', ['test' => $test, 'testQuestion' => $testQuestion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestQuestionRequest $request ,Test $test, TestQuestion $testQuestion)
    {
        try {
            $testQuestion->update([
                'test_id' => $test->id,
                'title' => $request->input('title'),
                'correct_answer' => $request->input('correct_answer'),
                'ancillary_answer' => json_encode($request->input('ancillary_answer')),
                'option_one' => $request->input('option_one'),
                'option_two' => $request->input('option_two'),
                'option_three' => $request->input('option_three'),
                'option_four' => $request->input('option_four'),
                'level' => $request->input('level'),
            ]);

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.testQuestions.create', ['test' => $test]);
        }
        catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.testQuestions.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TestQuestion $testQuestion)
    {
        try {
            $testQuestion->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
