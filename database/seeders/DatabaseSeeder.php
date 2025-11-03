<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CmsSettingsSeeder::class,
            BusinessInfoSeeder::class,

            // Related business info content
            HeroSectionSeeder::class,
            AboutSectionSeeder::class,
            ContactInfoSeeder::class,
            SocialMediaSeeder::class,

            // Operations
            OperatingHourSeeder::class,
            DeliveryPlatformSeeder::class,
            DeliverySettingSeeder::class,

            // Content
            FaqCategorySeeder::class,
            CategoriesSeeder::class,
            MenuItemsSeeder::class,
            TestimonialsSeeder::class,
            StoreScheduleSeeder::class,
        ]);
    }
}
