<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Budi Santoso',
                'customer_location' => 'Jakarta Selatan',
                'rating' => 5,
                'review_text' => 'Mie ikan laut pedas terenak yang pernah saya coba! Pedasnya pas, ikannya segar, dan kuahnya gurih banget. Pasti balik lagi!',
                'review_date' => '2024-10-15',
                'platform' => 'google',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'Sari Dewi',
                'customer_location' => 'Kemang',
                'rating' => 5,
                'review_text' => 'Sebagai pecinta makanan pedas, ini adalah surga! Level extra hot-nya beneran pedas tapi tetap enak. Recommended banget!',
                'review_date' => '2024-10-20',
                'platform' => 'instagram',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Ahmad Rizki',
                'customer_location' => 'Pondok Indah',
                'rating' => 4,
                'review_text' => 'Pertama kali cobain langsung ketagihan. Ikannya fresh, bumbu meresap sempurna. Cuma agak lama nunggunya karena rame.',
                'review_date' => '2024-10-25',
                'platform' => 'whatsapp',
                'is_featured' => false,
                'is_approved' => true,
                'sort_order' => 3,
            ],
            [
                'customer_name' => 'Maya Putri',
                'customer_location' => 'Senayan',
                'rating' => 5,
                'review_text' => 'Delivery cepat, packaging rapi, dan rasanya tetap enak sampai rumah. Mie goreng seafoodnya juara!',
                'review_date' => '2024-10-28',
                'platform' => 'facebook',
                'is_featured' => true,
                'is_approved' => true,
                'sort_order' => 4,
            ],
            [
                'customer_name' => 'Fajar Nugroho',
                'customer_location' => 'Jakarta Pusat',
                'rating' => 5,
                'review_text' => 'Anak saya yang biasanya susah makan langsung habis 1 mangkuk! Ternyata mie kuah ikan kakapnya cocok untuk anak-anak.',
                'review_date' => '2024-11-01',
                'platform' => 'direct',
                'is_featured' => false,
                'is_approved' => true,
                'sort_order' => 5,
            ],
            [
                'customer_name' => 'Linda Sari',
                'customer_location' => 'Blok M',
                'rating' => 4,
                'review_text' => 'Harga worth it banget dengan porsi yang banyak dan rasa yang mantap. Es jeruk perasnya juga seger!',
                'review_date' => '2024-11-02',
                'platform' => 'google',
                'is_featured' => false,
                'is_approved' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::create($testimonial);
        }
    }
}
