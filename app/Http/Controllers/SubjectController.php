<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudyProgram;
use App\Http\Requests\SubjectRequest;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('studyProgram')->latest()->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('subjects.create', compact('studyPrograms'));
    }

    public function store(SubjectRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Subject::create($request->validated());
            });

            return redirect()->route('subjects.index')
                ->with('success', 'Mata Kuliah berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(Subject $subject)
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('subjects.edit', compact('subject', 'studyPrograms'));
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        try {
            DB::transaction(function () use ($request, $subject) {
                $subject->update($request->validated());
            });

            return redirect()->route('subjects.index')
                ->with('success', 'Mata Kuliah berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return redirect()->route('subjects.index')
                ->with('success', 'Mata Kuliah dipindahkan ke tempat sampah.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
