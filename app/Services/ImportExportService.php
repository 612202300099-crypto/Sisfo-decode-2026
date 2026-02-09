<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportExportService
{
    /**
     * Get columns based on type
     */
    public function getColumns(string $type): array
    {
        return match ($type) {
            'study-programs' => ['Kode', 'Nama Program Studi'],
            'students' => ['NIM', 'Nama Mahasiswa', 'Kode Program Studi'],
            'subjects' => ['Kode MK', 'Nama Mata Kuliah', 'Kode Program Studi'],
            default => [],
        };
    }

    /**
     * Get data for export
     */
    public function getExportData(string $type): array
    {
        return match ($type) {
            'study-programs' => StudyProgram::all()->map(fn($item) => [$item->code, $item->name])->toArray(),
            'students' => Student::with('studyProgram')->get()->map(fn($item) => [
                $item->nim, 
                $item->name, 
                $item->studyProgram->code ?? ''
            ])->toArray(),
            'subjects' => Subject::with('studyProgram')->get()->map(fn($item) => [
                $item->code, 
                $item->name, 
                $item->studyProgram->code ?? ''
            ])->toArray(),
            default => [],
        };
    }

    /**
     * Process a single row during import
     */
    public function processRow(string $type, array $row, int $lineNumber): array
    {
        $row = array_map('trim', $row);
        $expectedHeader = $this->getColumns($type);

        if (empty($row) || count($row) < count($expectedHeader) || empty($row[0])) {
            return ['status' => 'skip'];
        }

        try {
            return match ($type) {
                'study-programs' => $this->importStudyProgram($row, $lineNumber),
                'students' => $this->importStudent($row, $lineNumber),
                'subjects' => $this->importSubject($row, $lineNumber),
                default => ['status' => 'error', 'message' => "Tipe data tidak dikenal."],
            };
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => "Baris $lineNumber: Terjadi kesalahan: " . $e->getMessage()];
        }
    }

    private function importStudyProgram(array $row, int $lineNumber): array
    {
        $data = ['code' => $row[0], 'name' => $row[1]];
        $validator = Validator::make($data, [
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
        }

        DB::transaction(function () use ($data) {
            $existing = StudyProgram::withTrashed()->where('code', $data['code'])->first();
            if ($existing) {
                if ($existing->trashed()) {
                    $existing->restore();
                }
                $existing->update(['name' => $data['name']]);
            } else {
                StudyProgram::create($data);
            }
        });

        return ['status' => 'success'];
    }

    private function importStudent(array $row, int $lineNumber): array
    {
        $data = ['nim' => $row[0], 'name' => $row[1], 'study_program_code' => $row[2]];
        
        $validator = Validator::make($data, [
            'nim' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'study_program_code' => 'required|exists:study_programs,code',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
        }

        $sp = StudyProgram::where('code', $data['study_program_code'])->first();

        DB::transaction(function () use ($data, $sp) {
            $existing = Student::withTrashed()->where('nim', $data['nim'])->first();
            if ($existing) {
                if ($existing->trashed()) {
                    $existing->restore();
                }
                $existing->update([
                    'name' => $data['name'],
                    'study_program_id' => $sp->id
                ]);
            } else {
                Student::create([
                    'nim' => $data['nim'],
                    'name' => $data['name'],
                    'study_program_id' => $sp->id
                ]);
            }
        });

        return ['status' => 'success'];
    }

    private function importSubject(array $row, int $lineNumber): array
    {
        $data = ['code' => $row[0], 'name' => $row[1], 'study_program_code' => $row[2]];
        
        $validator = Validator::make($data, [
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'study_program_code' => 'required|exists:study_programs,code',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
        }

        $sp = StudyProgram::where('code', $data['study_program_code'])->first();

        DB::transaction(function () use ($data, $sp) {
            $existing = Subject::withTrashed()->where('code', $data['code'])->first();
            if ($existing) {
                if ($existing->trashed()) {
                    $existing->restore();
                }
                $existing->update([
                    'name' => $data['name'],
                    'study_program_id' => $sp->id
                ]);
            } else {
                Subject::create([
                    'code' => $data['code'],
                    'name' => $data['name'],
                    'study_program_id' => $sp->id
                ]);
            }
        });

        return ['status' => 'success'];
    }
}
