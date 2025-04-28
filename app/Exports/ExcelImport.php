<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class ExcelImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading
{
    protected $model;
    protected $fields;

    public function __construct(string $model, array $fields)
    {
        $this->model = $model;
        $this->fields = $fields;
    }

    public function model(array $row)
    {
        try {
            // Make sure the row has the correct data structure
            $data = [];
            foreach ($this->fields as $field) {
                $data[$field] = $row[$field] ?? null; // Ensure it gets null if the field is missing
            }

            // Return the model instance
            return new $this->model($data);
        } catch (\Exception $e) {
            Log::error('Import failed for row: ' . json_encode($row) . ' Error: ' . $e->getMessage());
            return null; // In case of error, return null (row will be skipped)
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Specify the chunk size (adjust based on your needs)
    }
}
