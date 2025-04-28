<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Roles::create([
            'id' => (string) \Str::uuid(),
            'name' => 'Administrator',
            'permissions' => json_encode([ 'is_admin' =>'manage_users', '' => 'approve_leaves']),
            'is_active' => true,
            'description' => 'Administrator penuh hak akses.',
            'level' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        User::create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->name
        ]);





DB::table('leave_types')->insert([
    'id' => Str::uuid(),
    'name' => 'Cuti Tahunan',
    'description' => json_encode(['id' => 'Cuti tahunan reguler', 'en' => 'Regular annual leave']),
    'is_active' => true,
    'created_at' => now(),
    'updated_at' => now(),
]);


        // $this->call(LeaveTypeSeeder::class);
    }
}
