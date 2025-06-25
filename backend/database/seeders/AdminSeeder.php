<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@madinah-hackathon.com',
            'password' => Hash::make('admin123'),
        ]);

        $this->command->info('Default admin user created successfully!');
        $this->command->info('Email: admin@madinah-hackathon.com');
        $this->command->info('Password: admin123');
    }
}
