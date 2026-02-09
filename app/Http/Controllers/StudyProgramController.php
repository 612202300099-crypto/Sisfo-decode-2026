<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use App\Http\Requests\StudyProgramRequest;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    public function index()
    {
        $studyPrograms = StudyProgram::latest()->get();
        return view('study-programs.index', compact('studyPrograms'));
    }

    public function create()
    {
        return view('study-programs.create');
    }

    public function store(StudyProgramRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                StudyProgram::create($request->validated());
            });

            return redirect()->route('study-programs.index')
                ->with('success', 'Program Studi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(StudyProgram $studyProgram)
    {
        return view('study-programs.edit', compact('studyProgram'));
    }

    public function update(StudyProgramRequest $request, StudyProgram $studyProgram)
    {
        try {
            DB::transaction(function () use ($request, $studyProgram) {
                $studyProgram->update($request->validated());
            });

            return redirect()->route('study-programs.index')
                ->with('success', 'Program Studi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy(StudyProgram $studyProgram)
    {
        try {
            // Safety check: Prevent deletion if there are active students or subjects
            if ($studyProgram->students()->count() > 0 || $studyProgram->subjects()->count() > 0) {
                return redirect()->route('study-programs.index')
                    ->with('error', 'Tidak dapat menghapus Program Studi yang masih memiliki Mahasiswa atau Mata Kuliah aktif.');
            }

            $studyProgram->delete();
            return redirect()->route('study-programs.index')
                ->with('success', 'Program Studi dipindahkan ke tempat sampah.');
        } catch (\Exception $e) {
            return redirect()->route('study-programs.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
