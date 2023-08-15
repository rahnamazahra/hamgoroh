<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Step;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Step $step)
    {
        $item = $request->query('search_item');
        $schedules = Schedule::where('step_id', $step->id)->when($item, function (Builder $builder) use ($item) {
            $builder->whereRelation('step', 'title', 'LIKE', "%{$item}%");
        })
            ->paginate(10);

        return view('admin.schedules.index', ['schedules' => $schedules, 'step' => $step]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Step $step)
    {
        return view('admin.schedules.create', ['step' => $step]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request, Step $step)
    {
        try {
            $groups = $request->input('groups');
            foreach ($groups as $group){
                foreach ($group['time'] as $item) {
                    $start_time = $item['start_time1'] . ':' . $item['start_time2'] . ':00';
                    $finish_time = $item['finish_time1'] . ':' . $item['finish_time2'] . ':00';
                    Schedule::create([
                        'step_id' => $step->id,
                        'from_time' => Jalalian::fromFormat('Y/m/d', $group['date'])->toCarbon()->format('Y-m-d') . ' ' . $start_time,
                        'to_time' => Jalalian::fromFormat('Y/m/d', $group['date'])->toCarbon()->format('Y-m-d') . ' ' . $finish_time,
                    ]);
                }
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');
            return redirect()->route('admin.schedules.index', ['step' => $step->id]);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule, Step $step)
    {
        $users = Role::find(7)->users;
        return view('admin.schedules.edit', ['schedule' => $schedule, 'step' => $step, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, Schedule $schedule, Step $step)
    {
        try {
            $start_time = $request->input('start_time1') . ':' . $request->input('start_time2') . ':00';
            $finish_time = $request->input('finish_time1') . ':' . $request->input('finish_time2') . ':00';
            $schedule->update([
                'step_id' => $step->id,
                'from_time' => Jalalian::fromFormat('Y/m/d', $request->input('date'))->toCarbon()->format('Y-m-d') . ' ' . $start_time,
                'to_time' => Jalalian::fromFormat('Y/m/d', $request->input('date'))->toCarbon()->format('Y-m-d') . ' ' . $finish_time,
            ]);
            if ($request->input('user_id')){
                $schedule->user_id = $request->input('user_id');
                $schedule->is_reserved = true;
                $schedule->save();
            }

            Alert('success', 'اطلاعات باموفقیت ویرایش شد.');
            return redirect()->route('admin.schedules.index', ['step' => $step->id]);
        } catch (Exception $e) {
            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');
            return redirect()->route('admin.schedules.index', ['step' => $step->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
