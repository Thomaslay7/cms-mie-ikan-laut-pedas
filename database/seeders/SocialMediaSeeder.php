<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
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

        $socialMediaAccounts = [
            [
                'business_info_id' => $businessInfo->id,
                'platform' => 'instagram',
                'url' => 'https://instagram.com/mieikanlautpedas',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'platform' => 'tiktok',
                'url' => 'https://tiktok.com/@mieikanlautpedas',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'platform' => 'facebook',
                'url' => 'https://facebook.com/mieikanlautpedas',
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'platform' => 'youtube',
                'url' => 'https://youtube.com/@mieikanlautpedas',
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'platform' => 'whatsapp',
                'url' => 'https://wa.me/6281234567890',
                'is_active' => true,
                'display_order' => 0,
            ],
        ];

        foreach ($socialMediaAccounts as $account) {
            \App\Models\SocialMedia::create($account);
        }

        $this->command->info('Social media accounts seeded successfully!');
    }
}
