<?php

namespace App\Http\Controllers;

use App\Services\ImportExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportExportController extends Controller
{
    protected $service;

    public function __construct(ImportExportService $service)
    {
        $this->service = $service;
    }

    /**
     * Export data to CSV
     */
    public function export($type)
    {
        $filename = "export_{$type}_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = $this->service->getColumns($type);
        $data = $this->service->getExportData($type);

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

        $columns = $this->service->getColumns($type);

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
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        
        $header = fgetcsv($handle);
        $expectedHeader = $this->service->getColumns($type);

        if (!$header || count($header) < count($expectedHeader)) {
            fclose($handle);
            return back()->with('error', 'Format file tidak sesuai atau file kosong.');
        }

        $successCount = 0;
        $errors = [];
        $lineNumber = 1;

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle)) !== FALSE) {
                $lineNumber++;
                
                $result = $this->service->processRow($type, $row, $lineNumber);
                
                if ($result['status'] === 'success') {
                    $successCount++;
                } elseif ($result['status'] === 'error') {
                    $errors[] = $result['message'];
                }
            }
            fclose($handle);

            if (!empty($errors)) {
                DB::rollBack();
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
}
