<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $students = Student::where('name', 'like', "%$query%")
            ->orWhere('nim', 'like', "%$query%")
            ->with('studyProgram')
            ->take(5)
            ->get()
            ->map(fn($item) => [
                'type' => 'Mahasiswa',
                'title' => $item->name,
                'subtitle' => $item->nim,
                'url' => route('students.edit', $item)
            ]);

        $subjects = Subject::where('name', 'like', "%$query%")
            ->orWhere('code', 'like', "%$query%")
            ->take(3)
            ->get()
            ->map(fn($item) => [
                'type' => 'Mata Kuliah',
                'title' => $item->name,
                'subtitle' => $item->code,
                'url' => route('subjects.edit', $item)
            ]);

        return response()->json($students->concat($subjects));
    }
}
