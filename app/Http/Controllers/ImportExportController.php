<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportExportController extends Controller
{
    /**
     * Export data to CSV (Excel compatible)
     */
    public function export($type)
    {
        $filename = "export_{$type}_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = $this->getColumns($type);
        $data = $this->getData($type);

        return new StreamedResponse(function () use ($columns, $data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        }, 200, $headers);
    }

    /**
     * Download CSV Template
     */
    public function template($type)
    {
        $filename = "template_{$type}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = $this->getColumns($type);

        return new StreamedResponse(function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Import data from CSV
     */
    public function import(Request $request, $type)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        
        // Remove header
        $header = fgetcsv($handle);
        
        // Basic check if header matches
        $expectedHeader = $this->getColumns($type);
        if (!$header || count($header) < count($expectedHeader)) {
            fclose($handle);
            return back()->with('error', 'Format file tidak sesuai or file kosong.');
        }

        $successCount = 0;
        $errors = [];
        $lineNumber = 1;

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle)) !== FALSE) {
                $lineNumber++;
                if (empty($row) || count($row) < count($expectedHeader) || empty($row[0])) continue;

                $result = $this->processRow($type, $row, $lineNumber);
                
                if ($result['status'] === 'success') {
                    $successCount++;
                } else {
                    $errors[] = $result['message'];
                }
            }
            fclose($handle);

            if (!empty($errors)) {
                DB::rollBack();
                // Return first 5 errors to avoid huge session data
                $limitedErrors = array_slice($errors, 0, 5);
                if (count($errors) > 5) {
                    $limitedErrors[] = "... dan " . (count($errors) - 5) . " kesalahan lainnya.";
                }
                return back()->withErrors($limitedErrors)->with('error', 'Impor gagal. Silakan periksa detail kesalahan.');
            }

            DB::commit();
            return back()->with('success', "Berhasil mengimpor $successCount data $type.");

        } catch (\Exception $e) {
            if (isset($handle)) fclose($handle);
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    private function getColumns($type)
    {
        return match ($type) {
            'study-programs' => ['Kode', 'Nama Program Studi'],
            'students' => ['NIM', 'Nama Mahasiswa', 'Kode Program Studi'],
            'subjects' => ['Kode MK', 'Nama Mata Kuliah', 'Kode Program Studi'],
            default => [],
        };
    }

    private function getData($type)
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

    private function processRow($type, $row, $lineNumber)
    {
        // Sanitize row
        $row = array_map('trim', $row);

        if ($type === 'study-programs') {
            $data = ['code' => $row[0], 'name' => $row[1]];
            $validator = Validator::make($data, [
                'code' => 'required|string|max:10|unique:study_programs,code',
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
            }

            StudyProgram::create($data);
        } 
        elseif ($type === 'students') {
            $data = ['nim' => $row[0], 'name' => $row[1], 'study_program_code' => $row[2]];
            
            $validator = Validator::make($data, [
                'nim' => 'required|string|max:20|unique:students,nim',
                'name' => 'required|string|max:255',
                'study_program_code' => 'required|exists:study_programs,code',
            ], [
                'study_program_code.exists' => "Kode Program Studi '{$data['study_program_code']}' tidak terdaftar.",
            ]);

            if ($validator->fails()) {
                return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
            }

            $sp = StudyProgram::where('code', $data['study_program_code'])->first();
            Student::create([
                'nim' => $data['nim'],
                'name' => $data['name'],
                'study_program_id' => $sp->id
            ]);
        }
        elseif ($type === 'subjects') {
            $data = ['code' => $row[0], 'name' => $row[1], 'study_program_code' => $row[2]];
            
            $validator = Validator::make($data, [
                'code' => 'required|string|max:20',
                'name' => 'required|string|max:255',
                'study_program_code' => 'required|exists:study_programs,code',
            ], [
                'study_program_code.exists' => "Kode Program Studi '{$data['study_program_code']}' tidak terdaftar.",
            ]);

            if ($validator->fails()) {
                return ['status' => 'error', 'message' => "Baris $lineNumber: " . implode(', ', $validator->errors()->all())];
            }

            $sp = StudyProgram::where('code', $data['study_program_code'])->first();
            Subject::create([
                'code' => $data['code'],
                'name' => $data['name'],
                'study_program_id' => $sp->id
            ]);
        }

        return ['status' => 'success'];
    }
}
