<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Models\Competition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Throwable;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $competitions = Competition::with(['user'])
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                    ->orWhere('registration_description', 'LIKE', "%{$item}%")
                    ->orWhere('rules_description', 'LIKE', "%{$item}%")
                    ->orWhere('letter_method', 'LIKE', "%{$item}%")
                    ->orWhere('banner', 'LIKE', "%{$item}%")
                    ->orWhereRelation('user', 'first_name', 'LIKE', "%{$item}%")
                    ->orWhereRelation('user', 'last_name', 'LIKE', "%{$item}%");
            })
            ->paginate(10);

        return view('admin.competitions.index', ['competitions' => $competitions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();

        return view('admin.competitions.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionRequest $request)
    {
        try {
                $competition = Competition::create([
//                'title' => $request->input('title'),
//                'is_active' => $request->input('is_active'),
//                'registration_start_date' => Jalalian::fromFormat('Y/m/d', $request->input('registration_start_date'))->toCarbon(),
//                'registration_finish_date' => Jalalian::fromFormat('Y/m/d', $request->input('registration_finish_date'))->toCarbon(),
//                'registration_start_time' => $request->input('start_time1') . ':' . $request->input('start_time2'),
//                'registration_finish_time' => $request->input('finish_time1') . ':' . $request->input('finish_time2'),
//                'registration_description' => $request->input('registration_description'),
//                'rules_description' => $request->input('rules_description'),
//                'letter_method' => $request->input('letter_method'),
//                'banner' => $request->input('banner'),
//                'creator' => $request->input('creator'),
            ]);

            return redirect()->route('admin.competitions.edit', ['competition' => $competition])->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->route('admin.competitions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        $users = User::get();

        return view('admin.competitions.informations.edit', ['competition' => $competition, 'users' => $users]);
    }

    public function show(Competition $competition)
    {
        return view('admin.competitions.show', ['competition' => $competition]);
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
//                'registration_start_date' => Jalalian::fromFormat('Y/m/d', $request->input('registration_start_date'))->toCarbon(),
                'registration_start_date' => $request->input('registration_start_date') ? Jalalian::fromFormat('Y/m/d', $request->input('registration_start_date'))->toCarbon() : null,
                'registration_finish_date' => $request->input('registration_finish_date') ? Jalalian::fromFormat('Y/m/d', $request->input('registration_finish_date'))->toCarbon() : null,
                'registration_start_time' => $request->input('start_time1') ? $request->input('start_time1') . ':' . $request->input('start_time2') : null,
                'registration_finish_time' => $request->input('finish_time1') ? $request->input('finish_time1') . ':' . $request->input('finish_time2') : null,
                'registration_description' => $request->input('registration_description'),
                'rules_description' => $request->input('rules_description'),
                'letter_method' => $request->input('letter_method'),
                'banner' => $request->input('banner'),
                'creator' => $request->input('creator'),
            ]);
            return redirect()->route('admin.competitions.index')->with('success', 'ویرایش اطلاعات  باموفقیت انجام شد.');
        }catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
// catch (\Exception $e) {
//            return redirect()->route('admin.competitions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
//        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Competition $competition)
    {
        try {
            $competition->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
