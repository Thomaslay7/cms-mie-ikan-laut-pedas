<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Mie Ikan Laut Pedas',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of the website',
                'is_public' => true,
            ],
            [
                'key' => 'site_description',
                'value' => 'Warung mie ikan laut pedas dengan cita rasa autentik dan bahan-bahan segar pilihan. Nikmati sensasi pedas yang menggoda di setiap suapan!',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'Brief description of the website',
                'is_public' => true,
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@mieikamlautpedas.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address',
                'is_public' => true,
            ],
            [
                'key' => 'contact_phone',
                'value' => '081234567890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number',
                'is_public' => true,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '6281234567890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp Number',
                'description' => 'WhatsApp number with country code',
                'is_public' => true,
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/mieikamlautpedas',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'social_tiktok',
                'value' => 'https://tiktok.com/@mieikamlautpedas',
                'type' => 'text',
                'group' => 'social',
                'label' => 'TikTok URL',
                'description' => 'TikTok profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'delivery_fee',
                'value' => '5000',
                'type' => 'number',
                'group' => 'delivery',
                'label' => 'Delivery Fee',
                'description' => 'Standard delivery fee in IDR',
                'is_public' => true,
            ],
            [
                'key' => 'minimum_order',
                'value' => '25000',
                'type' => 'number',
                'group' => 'delivery',
                'label' => 'Minimum Order',
                'description' => 'Minimum order amount in IDR',
                'is_public' => true,
            ],
            [
                'key' => 'free_delivery_minimum',
                'value' => '50000',
                'type' => 'number',
                'group' => 'delivery',
                'label' => 'Free Delivery Minimum',
                'description' => 'Minimum order for free delivery in IDR',
                'is_public' => true,
            ],
            [
                'key' => 'operating_hours',
                'value' => json_encode([
                    'monday' => ['open' => '08:00', 'close' => '22:00'],
                    'tuesday' => ['open' => '08:00', 'close' => '22:00'],
                    'wednesday' => ['open' => '08:00', 'close' => '22:00'],
                    'thursday' => ['open' => '08:00', 'close' => '22:00'],
                    'friday' => ['open' => '08:00', 'close' => '22:00'],
                    'saturday' => ['open' => '08:00', 'close' => '23:00'],
                    'sunday' => ['open' => '08:00', 'close' => '23:00'],
                ]),
                'type' => 'json',
                'group' => 'general',
                'label' => 'Operating Hours',
                'description' => 'Restaurant operating hours',
                'is_public' => true,
            ],
            [
                'key' => 'google_analytics_id',
                'value' => 'GA-XXXXXXXX',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Analytics ID',
                'description' => 'Google Analytics tracking ID',
                'is_public' => false,
            ],
            [
                'key' => 'meta_title_template',
                'value' => '{title} | Mie Ikan Laut Pedas',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Title Template',
                'description' => 'Template for page titles, use {title} placeholder',
                'is_public' => false,
            ],
            [
                'key' => 'meta_description_default',
                'value' => 'Nikmati mie ikan laut pedas terenak dengan cita rasa autentik. Delivery tersedia. Pesan sekarang!',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Default Meta Description',
                'description' => 'Default meta description for pages without specific description',
                'is_public' => false,
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\CmsSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
