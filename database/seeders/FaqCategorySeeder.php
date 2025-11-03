<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pemesanan',
                'slug' => 'pemesanan',
                'description' => 'Pertanyaan seputar cara pemesanan dan proses order',
                'icon' => 'heroicon-o-shopping-cart',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pengiriman & Delivery',
                'slug' => 'pengiriman-delivery',
                'description' => 'Informasi tentang pengiriman, ongkos kirim, dan area delivery',
                'icon' => 'heroicon-o-truck',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Menu & Produk',
                'slug' => 'menu-produk',
                'description' => 'Pertanyaan tentang menu, bahan, dan tingkat kepedasan',
                'icon' => 'heroicon-o-document-text',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Pembayaran',
                'slug' => 'pembayaran',
                'description' => 'Informasi metode pembayaran dan proses transaksi',
                'icon' => 'heroicon-o-credit-card',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Umum',
                'slug' => 'umum',
                'description' => 'Pertanyaan umum seputar restoran dan layanan',
                'icon' => 'heroicon-o-question-mark-circle',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Keluhan & Saran',
                'slug' => 'keluhan-saran',
                'description' => 'Tempat untuk keluhan pelanggan dan saran perbaikan',
                'icon' => 'heroicon-o-exclamation-triangle',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\FaqCategory::create($category);
        }
    }
}
