<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class ExcelExport implements FromCollection, WithHeadings, ShouldQueue, WithChunkReading
{
    protected $model;
    protected $fields;

    public function __construct(string $model , array $fields)
    {
        $this->model = $model;
        $this->fields = $fields;
    }

    public function collection()
    {
        return app($this->model)::select($this->fields)->get();
    }

    public function headings(): array
    {
        return $this->fields;
    }
    public function chunkSize(): int
    {
        return 1000; // Specify the chunk size (adjust this based on your needs)
    }
}
