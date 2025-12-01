<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // The logic to create a default admin is now handled by the AssignAdminRole listener.
        // You can add other seeders here if needed.

        // For example:
        // $this->call([
        //     DepartmentSeeder::class,
        // ]);
    }
}
