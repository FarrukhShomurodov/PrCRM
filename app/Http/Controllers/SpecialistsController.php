<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialistRequest;
use App\Models\specialist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class SpecialistsController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $specialists = specialist::query()->get();
        return view('admin.specialist.index', ['specialists' => $specialists]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.specialist.create');
    }

    /**
     * @param SpecialistRequest $request
     * @return string
     */
    public function store(SpecialistRequest $request): string
    {
        specialist::query()->create($request->validated());
        return redirect()->route('specialists.index');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(specialist $specialist): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.specialist.edit',["specialist" => $specialist]);
    }

    /**
     * @param specialist $specialist
     * @param SpecialistRequest $request
     * @return RedirectResponse
     */
    public function update(specialist $specialist, SpecialistRequest $request): \Illuminate\Http\RedirectResponse
    {
        $specialist->update($request->validated());
        return redirect()->route('specialists.index');
    }

    /**
     * @param specialist $specialist
     * @return RedirectResponse
     */
    public function destroy(specialist $specialist): RedirectResponse
    {
        $specialist->delete();
        return redirect()->route('specialists.index');
    }
}
