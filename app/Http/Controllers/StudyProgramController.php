<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyPrograms = StudyProgram::latest()->get();
        return view('study-programs.index', compact('studyPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study-programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:study_programs,code',
        ], [
            'name.required' => 'Nama program studi wajib diisi.',
            'code.required' => 'Kode program studi wajib diisi.',
            'code.unique' => 'Kode program studi sudah digunakan.',
        ]);

        StudyProgram::create($validated);

        return redirect()->route('study-programs.index')
            ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyProgram $studyProgram)
    {
        return redirect()->route('study-programs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $studyProgram)
    {
        return view('study-programs.edit', compact('studyProgram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $studyProgram)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:study_programs,code,' . $studyProgram->id,
        ], [
            'name.required' => 'Nama program studi wajib diisi.',
            'code.required' => 'Kode program studi wajib diisi.',
            'code.unique' => 'Kode program studi sudah digunakan.',
        ]);

        $studyProgram->update($validated);

        return redirect()->route('study-programs.index')
            ->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        try {
            $studyProgram->delete();
            return redirect()->route('study-programs.index')
                ->with('success', 'Program Studi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('study-programs.index')
                ->with('error', 'Gagal menghapus Program Studi. Mungkin masih ada data terkait.');
        }
    }
}
