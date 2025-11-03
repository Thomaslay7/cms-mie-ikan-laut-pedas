<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySettingSeeder extends Seeder
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

        \App\Models\DeliverySetting::create([
            'business_info_id' => $businessInfo->id,
            'minimum_order' => 50000.00,
            'delivery_fee' => 10000.00,
            'free_delivery_threshold' => 100000.00,
            'delivery_radius_km' => 10,
            'estimated_delivery_time_min' => 45,
            'delivery_areas' => [
                'Jakarta Selatan',
                'Jakarta Pusat',
                'Jakarta Barat',
                'Jakarta Timur',
                'Jakarta Utara',
                'Tangerang Selatan',
                'Depok',
                'Bekasi'
            ],
            'is_delivery_enabled' => true,
            'is_pickup_enabled' => true,
            'delivery_notes' => 'Gratis ongkir untuk pembelian di atas Rp 100.000. Estimasi waktu pengiriman 30-60 menit tergantung lokasi dan kondisi traffic.',
        ]);
    }
}
