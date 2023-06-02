<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\job;
use App\Models\salary;
use App\Models\specialist;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class JobsController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $jobs = job::query()->get();
        $specialists = specialist::query()->get();
        return view('admin.jobs.index', ['jobs' => $jobs, 'specialists' => $specialists]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.jobs.create');
    }

    /**
     * @param JobRequest $request
     * @return RedirectResponse
     */
    public function store(JobRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $countOfSPentTime = 0;
        $job = job::query()->where("specialist_id","=", $validated["specialist_id"])->get('spent_time')->toArray();
        for ($i = 0; $i < count($job); $i++) {
            $countOfSPentTime += $job[$i]['spent_time'];
        }
        if($countOfSPentTime <=  100) {
            job::query()->create($validated);
            //Salary Store

            $CountOFSalary = $validated["spent_time"] * 50000;

            $salary = salary::query()->whereIntegerInRaw('specialist_id', [$validated['specialist_id']])->get()->last();

            $dateNow = Carbon::now();

            if ($salary != null && Carbon::parse($salary->toArraY()['created_at'])->month == $dateNow->month && Carbon::parse($salary->toArraY()['created_at'])->year == $dateNow->year) {
                $CountOFSalary += $salary->toArray()["month"];
                $spentTimeOFMonth = $salary->toArray()["amount_of_hours"] + $validated['spent_time'];
                salary::query()->find($salary->toArray()['id'])->update([
                    'specialist_id' => $validated['specialist_id'],
                    'month' => $CountOFSalary,
                    'year' => $CountOFSalary,
                    'amount_of_hours' => $spentTimeOFMonth,
                    'created_at' => $dateNow
                ]);
            } else {
                salary::query()->create([
                    'specialist_id' => $validated['specialist_id'],
                    'month' => $CountOFSalary,
                    'year' => $CountOFSalary,
                    'amount_of_hours' => $validated["spent_time"],
                    'created_at' => $dateNow,
                ]);
            }

        }
        return redirect()->route('jobs.index');
    }

}
