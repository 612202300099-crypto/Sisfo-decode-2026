<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('studyProgram')->latest()->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('subjects.create', compact('studyPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20',
            'study_program_id' => 'required|exists:study_programs,id',
        ], [
            'name.required' => 'Nama mata kuliah wajib diisi.',
            'code.required' => 'Kode mata kuliah wajib diisi.',
            'study_program_id.required' => 'Program studi wajib dipilih.',
            'study_program_id.exists' => 'Program studi tidak valid.',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return redirect()->route('subjects.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('subjects.edit', compact('subject', 'studyPrograms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20',
            'study_program_id' => 'required|exists:study_programs,id',
        ], [
            'name.required' => 'Nama mata kuliah wajib diisi.',
            'code.required' => 'Kode mata kuliah wajib diisi.',
            'study_program_id.required' => 'Program studi wajib dipilih.',
            'study_program_id.exists' => 'Program studi tidak valid.',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
