<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get business info ID
        $businessInfo = \App\Models\BusinessInfo::first();

        if (!$businessInfo) {
            $this->command->error('BusinessInfo not found. Please run BusinessInfoSeeder first.');
            return;
        }

        $heroSections = [
            [
                'business_info_id' => $businessInfo->id,
                'image' => 'images/hero/hero-main.jpg',
                'title' => 'Mie Ikan Laut Pedas Terenak di Jakarta!',
                'subtitle' => 'Nikmati sensasi pedas yang menggugah selera dengan ikan laut segar dan mie berkualitas tinggi',
                'cta_text' => 'Pesan Sekarang',
                'cta_link' => 'https://wa.me/6281234567890?text=Halo%20saya%20mau%20pesan%20mie%20ikan%20laut%20pedas',
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'image' => 'images/hero/hero-promo.jpg',
                'title' => 'Promo Spesial Bulan Ini!',
                'subtitle' => 'Beli 2 Gratis 1 untuk paket Mie Ikan Laut Pedas Level Medium. Buruan pesan sebelum kehabisan!',
                'cta_text' => 'Ambil Promo',
                'cta_link' => '/menu?promo=beli2gratis1',
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'business_info_id' => $businessInfo->id,
                'image' => 'images/hero/hero-delivery.jpg',
                'title' => 'Gratis Ongkir untuk Pesanan di Atas 100rb',
                'subtitle' => 'Pesan melalui aplikasi delivery partner atau langsung via WhatsApp untuk pengalaman terbaik',
                'cta_text' => 'Order Online',
                'cta_link' => '/delivery',
                'is_active' => false,
                'display_order' => 3,
            ],
        ];

        foreach ($heroSections as $section) {
            \App\Models\HeroSection::create($section);
        }

        $this->command->info('Hero sections seeded successfully!');
    }
}
