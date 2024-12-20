<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
    /**
     * Display a listing of vacancies.
     */
    public function index(): \Inertia\Response
    {
        $vacancies = Vacancy::latest()->paginate(10);

        return Inertia::render('Vacancies/VacancyIndex',['vacancies' => $vacancies]);

    }

    /**
     * Show the form for creating a new vacancy.
     */
    public function create()
    {
        return Inertia::render('Vacancies/Create');
    }

    /**
     * Store a newly created vacancy.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'status' => 'required|in:open,closed'
        ])->validate();

        Vacancy::create($validated);

        return redirect()->route('vacancies.index')
            ->with('message', 'Vacancy created successfully.');
    }

    /**
     * Display the specified vacancy.
     */
    public function show(Vacancy $vacancy)
    {
        return Inertia::render('Vacancies/Show', [
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Show the form for editing the specified vacancy.
     */
    public function edit(Vacancy $vacancy)
    {
        return Inertia::render('Vacancies/Edit', [
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Update the specified vacancy.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'status' => 'required|in:open,closed'
        ])->validate();

        $vacancy->update($validated);

        return redirect()->route('vacancies.index')
            ->with('message', 'Vacancy updated successfully.');
    }

    /**
     * Remove the specified vacancy.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

        return redirect()->route('vacancies.index')
            ->with('message', 'Vacancy deleted successfully.');
    }
}
