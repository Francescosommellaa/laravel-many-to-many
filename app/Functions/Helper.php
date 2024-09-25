<?php

namespace App\Functions;

use App\Models\Project;
use App\Models\Technology;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\ProgrammingLanguage;

class Helper
{
    public static function seedFakeProjects($count = 100)
    {
        $faker = Faker::create();

        // Ottieni tutti gli ID delle tecnologie disponibili
        $technologyIds = Technology::pluck('id')->toArray();
        $programmingLanguageIds = ProgrammingLanguage::pluck('id')->toArray();

        for ($i = 0; $i < $count; $i++) {
            $project = Project::create([
                'name' => $faker->words(3, true),
                'description' => $faker->paragraphs(4, true),
                'programming_language_id' => $faker->numberBetween(1, 5),
                'img' => $faker->imageUrl(640, 480, 'business', true, 'Project'),
                'thumbnail_img' => $faker->imageUrl(150, 150, 'business', true, 'Thumbnail'),
                'website_url' => $faker->url,
                'slug' => Str::slug($faker->words(3, true)),
            ]);

            // Associa alcune tecnologie casuali al progetto
            $randomTechnologyIds = $faker->randomElements(
                $technologyIds,
                $faker->numberBetween(1, min(3, count($technologyIds)))
            );
            $project->technologies()->attach($randomTechnologyIds);
        }
    }
}
