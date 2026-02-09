<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\Subject;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $deletedStudents = Student::onlyTrashed()->with('studyProgram')->latest()->get();
        $deletedStudyPrograms = StudyProgram::onlyTrashed()->withCount(['students', 'subjects'])->latest()->get();
        $deletedSubjects = Subject::onlyTrashed()->with('studyProgram')->latest()->get();

        return view('pages.trash', compact('deletedStudents', 'deletedStudyPrograms', 'deletedSubjects'));
    }

    public function restore(string $type, $id)
    {
        try {
            $model = $this->getModel($type, $id);
            if ($model) {
                $model->restore();
                return back()->with('success', 'Data berhasil dikembalikan dari tempat sampah.');
            }
            return back()->with('error', 'Data tidak ditemukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memulihkan data: ' . $e->getMessage());
        }
    }

    public function forceDelete(string $type, $id)
    {
        try {
            $model = $this->getModel($type, $id);
            if ($model) {
                $model->forceDelete();
                return back()->with('success', 'Data berhasil dihapus secara permanen.');
            }
            return back()->with('error', 'Data tidak ditemukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus permanen: ' . $e->getMessage());
        }
    }

    private function getModel(string $type, $id)
    {
        return match ($type) {
            'student' => Student::onlyTrashed()->find($id),
            'study-program' => StudyProgram::onlyTrashed()->find($id),
            'subject' => Subject::onlyTrashed()->find($id),
            default => null,
        };
    }
}
