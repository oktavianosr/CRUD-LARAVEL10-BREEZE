<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use App\Exports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;


class ExportController extends Controller
{
    public function index()
    {
        return view('excel.export_import');
    }
    public function export(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'fields' => 'required|array'
        ]);
        $model = $request->input('model');
        $fields = $request->input('fields');
        $filename = class_basename($model) . '-' . time() . '.xlsx';

        // Menambahkan job ke dalam queue
        Excel::queue(new ExcelExport($model, $fields), 'exports/' . $filename, 'public');
        session(['export_filename' => $filename]);
        return back()->with('success', 'Export Sedang Berjalan...');

    }

    public function downloadExport($filename)
{
    $filePath = storage_path('app/public/exports/' . $filename);

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return back()->with('error', 'File tidak ditemukan.');
}


    public function import(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'file' => 'required|file|mimes:xlsx'
        ]);

        $model = $request->input('model');
        $fields = $request->input('file',[]);

        Excel::queueImport(new ExcelImport($model,$fields), $request->file('file'));
        return back()->with('success', 'Import Sedang Berjalan ...');
    }
    public function getFields(Request $request)
{
    $model = $request->input('model');
    $allowedModels = [
        'App\Models\User',
        'App\Models\LeaveRequest',
        'App\Models\LeaveTypes',
        'App\Models\Roles',
    ];

    if (!in_array($model, $allowedModels)) {
        return response()->json(['error' => 'Model tidak valid.'], 400);
    }

    $fields = (new $model)->getFillable();

    if (empty($fields)) {
        $table = (new $model)->getTable();
        $fields = Schema::getColumnListing($table);
    }

    return response()->json(['fields' => $fields]);
}

}
