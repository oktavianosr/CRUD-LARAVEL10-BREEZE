<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LeaveTypes;

class LeaveTypeSeeder extends Seeder {
    public function run(): void {
        $types = ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Melahirkan'];

        foreach ($types as $type) {
            LeaveTypes::create([
                'id' => (string) \Str::uuid(),
                'name' => $type
            ]);
        }
    }
}