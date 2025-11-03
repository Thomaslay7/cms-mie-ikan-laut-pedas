<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
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

        \App\Models\AboutSection::create([
            'business_info_id' => $businessInfo->id,
            'title' => 'Cerita Mie Ikan Laut Pedas',
            'description' => 'Berawal dari resep turun temurun keluarga nelayan Jawa Timur, Mie Ikan Laut Pedas hadir untuk memberikan pengalaman kuliner yang tak terlupakan. Dengan menggunakan ikan laut segar yang dipilih langsung dari pantai, dipadukan dengan bumbu rempah pilihan dan mie berkualitas tinggi, kami berkomitmen menghadirkan cita rasa otentik yang menggugah selera.

Setiap mangkuk mie ikan laut pedas kami dibuat dengan penuh cinta dan keahlian chef berpengalaman. Kami menawarkan berbagai tingkat kepedasan mulai dari mild hingga extra hot, sehingga setiap pelanggan dapat menikmati sesuai dengan preferensi mereka.

Bukan hanya soal rasa, kami juga mengutamakan kualitas bahan baku dan kebersihan dalam setiap proses memasak. Itulah mengapa Mie Ikan Laut Pedas menjadi pilihan utama para pecinta kuliner pedas di Jakarta.',
            'image' => 'images/about/restaurant-story.jpg',
            'is_active' => true,
        ]);

        $this->command->info('About section seeded successfully!');
    }
}
