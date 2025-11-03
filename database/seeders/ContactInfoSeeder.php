<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businessInfo = \App\Models\BusinessInfo::first();

        if (!$businessInfo) {
            $this->command->error('BusinessInfo not found. Please run BusinessInfoSeeder first.');
            return;
        }

        \App\Models\ContactInfo::create([
            'business_info_id' => $businessInfo->id,
            'phone' => '02187654321',
            'whatsapp' => '6281234567890',
            'email' => 'info@mieikanlautpedas.com',
            'address' => 'Jl. Kuliner Nusantara No. 123, Kebayoran Baru, Jakarta Selatan 12240',
            'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        $this->command->info('Contact info seeded successfully!');
    }
}
