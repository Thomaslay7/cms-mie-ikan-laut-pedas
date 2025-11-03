<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mie Pedas',
                'slug' => 'mie-pedas',
                'description' => 'Koleksi mie dengan berbagai tingkat kepedasan yang menggoda selera',
                'sort_order' => 1,
                'is_active' => true,
                'meta_title' => 'Mie Pedas - Menu Unggulan Mie Ikan Laut Pedas',
                'meta_description' => 'Nikmati koleksi mie pedas dengan berbagai tingkat kepedasan. Dari mild hingga extra hot!',
            ],
            [
                'name' => 'Mie Kuah',
                'slug' => 'mie-kuah',
                'description' => 'Mie berkuah hangat dengan kaldu ikan laut segar',
                'sort_order' => 2,
                'is_active' => true,
                'meta_title' => 'Mie Kuah - Kehangatan Kuah Ikan Laut Segar',
                'meta_description' => 'Mie kuah dengan kaldu ikan laut segar yang menghangatkan.',
            ],
            [
                'name' => 'Mie Goreng',
                'slug' => 'mie-goreng',
                'description' => 'Mie goreng dengan bumbu khas dan topping ikan laut',
                'sort_order' => 3,
                'is_active' => true,
                'meta_title' => 'Mie Goreng - Cita Rasa Khas Nusantara',
                'meta_description' => 'Mie goreng dengan bumbu khas dan topping ikan laut segar.',
            ],
            [
                'name' => 'Cemilan',
                'slug' => 'cemilan',
                'description' => 'Berbagai cemilan pendamping yang lezat',
                'sort_order' => 4,
                'is_active' => true,
                'meta_title' => 'Cemilan - Pendamping Sempurna',
                'meta_description' => 'Cemilan lezat sebagai pendamping mie atau camilan ringan.',
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Minuman segar untuk melengkapi hidangan',
                'sort_order' => 5,
                'is_active' => true,
                'meta_title' => 'Minuman - Kesegaran Pelengkap',
                'meta_description' => 'Berbagai pilihan minuman segar untuk melengkapi hidangan.',
            ],
            [
                'name' => 'Paket Hemat',
                'slug' => 'paket-hemat',
                'description' => 'Paket combo dengan harga spesial',
                'sort_order' => 6,
                'is_active' => true,
                'meta_title' => 'Paket Hemat - Lebih Kenyang, Lebih Hemat',
                'meta_description' => 'Paket combo hemat dengan kombinasi mie, cemilan, dan minuman.',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
