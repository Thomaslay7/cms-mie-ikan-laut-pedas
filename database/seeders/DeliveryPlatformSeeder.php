<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first business info ID
        $businessInfo = \App\Models\BusinessInfo::first();
        if (!$businessInfo) {
            $this->command->error('No business info found. Please run BusinessInfoSeeder first.');
            return;
        }

        $platforms = [
            [
                'name' => 'GrabFood',
                'url' => 'https://food.grab.com/id/en/restaurant/mie-ikan-laut-pedas',
                'logo_url' => 'images/platforms/grabfood.png',
                'commission_rate' => 25.00,
                'is_active' => true,
                'sort_order' => 1,
                'description' => 'Order through GrabFood for fast delivery',
                'contact_info' => [
                    'phone' => '+6281234567890',
                    'support_url' => 'https://help.grab.com'
                ],
            ],
            [
                'name' => 'GoFood',
                'url' => 'https://gofood.co.id/jakarta/restaurant/mie-ikan-laut-pedas',
                'logo_url' => 'images/platforms/gofood.png',
                'commission_rate' => 25.00,
                'is_active' => true,
                'sort_order' => 2,
                'description' => 'Order through GoFood with Gojek drivers',
                'contact_info' => [
                    'phone' => '+6281234567891',
                    'support_url' => 'https://help.gojek.com'
                ],
            ],
            [
                'name' => 'ShopeeFood',
                'url' => 'https://shopee.co.id/food/restaurant/mie-ikan-laut-pedas',
                'logo_url' => 'images/platforms/shopeefood.png',
                'commission_rate' => 23.00,
                'is_active' => true,
                'sort_order' => 3,
                'description' => 'Order through ShopeeFood with great deals',
                'contact_info' => [
                    'phone' => '+6281234567892',
                    'support_url' => 'https://help.shopee.co.id'
                ],
            ],
            [
                'name' => 'WhatsApp Order',
                'url' => 'https://wa.me/6281234567890?text=Halo%20saya%20mau%20pesan%20mie%20ikan%20laut%20pedas',
                'logo_url' => 'images/platforms/whatsapp.png',
                'commission_rate' => 0.00,
                'is_active' => true,
                'sort_order' => 0,
                'description' => 'Order directly through WhatsApp - No commission!',
                'contact_info' => [
                    'phone' => '+6281234567890',
                    'business_hours' => '10:00 - 22:00'
                ],
            ],
        ];

        foreach ($platforms as $platform) {
            $platform['business_info_id'] = $businessInfo->id;
            \App\Models\DeliveryPlatform::create($platform);
        }
    }
}
