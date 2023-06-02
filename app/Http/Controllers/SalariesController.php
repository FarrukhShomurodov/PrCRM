<?php

namespace App\Http\Controllers;

use App\Models\salary;
use App\Models\specialist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SalariesController extends Controller
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $salaries = salary::query()->get();
        $specialists = specialist::query()->get();
        return view('admin.salary.index', compact("salaries", "specialists"));
    }
}
