<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
            'username' => 'Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('Asukayang'),
            'security_question' => 'Nama pendiri Kusuma Agrowisata?',
            'security_answer' => \Illuminate\Support\Facades\Hash::make('Edi Antoro') // Added a dummy answer for now. User can change it.
        ]);
    }
}
