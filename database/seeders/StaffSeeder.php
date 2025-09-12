<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::truncate();
        $staff = new Staff();
        $staff->name = 'manager';
        $staff->email = 'manager@multishop.com';
        $staff->type = 'manager';
        $staff->password = bcrypt('password');
        $staff->save();
    }
}
