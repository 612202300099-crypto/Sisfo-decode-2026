<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudyProgram;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('studyProgram')->latest()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('students.create', compact('studyPrograms'));
    }

    public function store(StudentRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Student::create($request->validated());
            });

            return redirect()->route('students.index')
                ->with('success', 'Mahasiswa ' . $request->name . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan mahasiswa: ' . $e->getMessage());
        }
    }

    public function edit(Student $student)
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();
        return view('students.edit', compact('student', 'studyPrograms'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        try {
            DB::transaction(function () use ($request, $student) {
                $student->update($request->validated());
            });

            return redirect()->route('students.index')
                ->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')
                ->with('success', 'Mahasiswa berhasil dipindahkan ke tempat sampah.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
