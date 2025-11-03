<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = [
            [
                'category_id' => 1, // Mie Pedas
                'name' => 'Mie Ikan Laut Extra Pedas',
                'slug' => 'mie-ikan-laut-extra-pedas',
                'description' => 'Mie dengan kuah ikan laut segar dan level kepedasan maksimal. Dibuat dengan ikan kakap segar, cabai rawit super pedas, dan rempah rahasia yang membuat lidah bergoyang. Cocok untuk pecinta pedas sejati!',
                'short_description' => 'Mie ikan laut dengan level kepedasan maksimal untuk pecinta pedas sejati',
                'price' => 35000,
                'original_price' => 40000,

                'preparation_time' => 15,
                'is_featured' => true,
                'is_popular' => true,
                'is_available' => true,
                'sort_order' => 1,
                'ingredients' => ['Mie segar', 'Ikan kakap', 'Cabai rawit super', 'Bawang merah', 'Bawang putih', 'Jahe', 'Kunyit', 'Santan kelapa'],
                'nutrition_info' => ['kalori' => 450, 'protein' => 25, 'karbohidrat' => 55, 'lemak' => 12],
                'tags' => ['pedas', 'populer', 'signature', 'ikan segar'],
                'meta_title' => 'Mie Ikan Laut Extra Pedas - Menu Signature',
                'meta_description' => 'Coba mie ikan laut extra pedas kami dengan ikan kakap segar dan cabai pilihan.',
            ],
            [
                'category_id' => 1, // Mie Pedas
                'name' => 'Mie Ikan Tenggiri Pedas',
                'slug' => 'mie-ikan-tenggiri-pedas',
                'description' => 'Mie dengan ikan tenggiri segar dan bumbu pedas yang pas di lidah. Kuah gurih dengan aroma rempah yang menggugah selera.',
                'short_description' => 'Mie ikan tenggiri dengan bumbu pedas yang pas di lidah',
                'price' => 32000,

                'preparation_time' => 12,
                'is_featured' => false,
                'is_popular' => true,
                'is_available' => true,
                'sort_order' => 2,
                'ingredients' => ['Mie segar', 'Ikan tenggiri', 'Cabai merah', 'Bawang bombay', 'Serai', 'Daun jeruk'],
                'nutrition_info' => ['kalori' => 420, 'protein' => 28, 'karbohidrat' => 50, 'lemak' => 10],
                'tags' => ['pedas', 'tenggiri', 'segar'],
            ],
            [
                'category_id' => 2, // Mie Kuah
                'name' => 'Mie Kuah Ikan Kakap',
                'slug' => 'mie-kuah-ikan-kakap',
                'description' => 'Mie kuah dengan kaldu ikan kakap yang segar dan gurih. Hangat dan menyegarkan, cocok untuk segala cuaca.',
                'short_description' => 'Mie kuah dengan kaldu ikan kakap segar yang gurih dan hangat',
                'price' => 28000,

                'preparation_time' => 10,
                'is_featured' => true,
                'is_popular' => false,
                'is_available' => true,
                'sort_order' => 1,
                'ingredients' => ['Mie segar', 'Ikan kakap', 'Sayuran segar', 'Bawang daun', 'Seledri'],
                'nutrition_info' => ['kalori' => 380, 'protein' => 22, 'karbohidrat' => 48, 'lemak' => 8],
                'tags' => ['kuah', 'segar', 'sehat'],
            ],
            [
                'category_id' => 3, // Mie Goreng
                'name' => 'Mie Goreng Seafood',
                'slug' => 'mie-goreng-seafood',
                'description' => 'Mie goreng dengan campuran seafood segar: udang, cumi, dan ikan. Bumbu kecap manis khas yang menggugah selera.',
                'short_description' => 'Mie goreng dengan campuran seafood segar dan bumbu khas',
                'price' => 38000,

                'preparation_time' => 15,
                'is_featured' => true,
                'is_popular' => true,
                'is_available' => true,
                'sort_order' => 1,
                'ingredients' => ['Mie telur', 'Udang', 'Cumi', 'Ikan', 'Kecap manis', 'Cabai', 'Sayuran'],
                'nutrition_info' => ['kalori' => 520, 'protein' => 35, 'karbohidrat' => 60, 'lemak' => 15],
                'tags' => ['goreng', 'seafood', 'premium'],
            ],
            [
                'category_id' => 4, // Cemilan
                'name' => 'Kerupuk Ikan Laut',
                'slug' => 'kerupuk-ikan-laut',
                'description' => 'Kerupuk renyah dari ikan laut asli, cocok sebagai pendamping atau camilan.',
                'short_description' => 'Kerupuk renyah dari ikan laut asli',
                'price' => 8000,
                'preparation_time' => 2,
                'is_featured' => false,
                'is_popular' => false,
                'is_available' => true,
                'sort_order' => 1,
                'ingredients' => ['Ikan laut', 'Tepung tapioka', 'Garam', 'Penyedap alami'],
                'tags' => ['cemilan', 'renyah', 'ikan'],
            ],
            [
                'category_id' => 5, // Minuman
                'name' => 'Es Jeruk Peras',
                'slug' => 'es-jeruk-peras',
                'description' => 'Minuman segar dari jeruk peras asli yang menyegarkan. Cocok untuk menetralkan rasa pedas.',
                'short_description' => 'Minuman segar dari jeruk peras asli',
                'price' => 8000,
                'preparation_time' => 3,
                'is_featured' => false,
                'is_popular' => true,
                'is_available' => true,
                'sort_order' => 1,
                'ingredients' => ['Jeruk peras', 'Gula aren', 'Es batu', 'Air mineral'],
                'tags' => ['minuman', 'segar', 'alami'],
            ],
        ];

        foreach ($menuItems as $item) {
            \App\Models\MenuItem::create($item);
        }
    }
}
