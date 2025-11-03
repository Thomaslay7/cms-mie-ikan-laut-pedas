<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create basic business info only
        // Other data will be seeded in their respective seeders
        \App\Models\BusinessInfo::create([
            'business_name' => 'Mie Ikan Laut Pedas',
            'tagline' => 'Rasa Laut yang Menggoda di Setiap Suapan',
            'logo' => 'business/logo.png', // Logo will be uploaded via admin
        ]);
    }
}
