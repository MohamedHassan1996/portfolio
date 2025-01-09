<?php

namespace Database\Seeders\FrontPage;

use App\Enums\FrontPage\FrontPageSectionStatus;
use App\Enums\FrontPage\FrontPageStatus;
use App\Models\FrontPage\FrontPage;
use App\Models\FrontPage\FrontPageSection;
use App\Models\FrontPage\FrontPageSectionTranslation;
use App\Models\FrontPage\FrontPageTranslation;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class FrontPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frontPage = FrontPage::create([
            'is_active' => FrontPageStatus::ACTIVE->value
        ]);

        $frontPageTranslationEn = FrontPageTranslation::create([
            'front_page_id' => $frontPage->id,
            'locale' => 'en',
            'title' => 'Front Page',
            'slug' => 'front-page',
            'meta_data' => '[]',
        ]);

        $frontPageTranslationAr = FrontPageTranslation::create([
            'front_page_id' => $frontPage->id,
            'locale' => 'ar',
            'title' => 'الصفحة الرئيسية',
            'slug' => 'الصفحة-الرئيسية',
            'meta_data' => '[]',
        ]);

        $sections = [
            'hero_section',
            'about_us_section',
            'products_section',
            'why_us_section',
            'testimonials_section',
            'blog_section',
        ];

        foreach ($sections as $section) {
            $frontPageSection = FrontPageSection::create([
                'front_page_id' => $frontPage->id,
                'is_active' => FrontPageSectionStatus::ACTIVE->value
            ]);

            $frontPageSectionTranslationEn = FrontPageSectionTranslation::create([
                'front_page_section_id' => $frontPageSection->id,
                'locale' => 'en',
                'name' => $section,
                'content' => '[]',
            ]);

            $frontPageSectionTranslationAr = FrontPageSectionTranslation::create([
                'front_page_section_id' => $frontPageSection->id,
                'locale' => 'ar',
                'name' => $section,
                'content' => '[]',
            ]);
        }


    }
}
