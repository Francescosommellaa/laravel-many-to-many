<?php

namespace App\Functions;

use App\Models\Project;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class Helper
{
    public static function seedFakeProjects($count = 10)
    {
        // Crea un'istanza di Faker
        $faker = Faker::create();

        // Loop per creare i progetti fittizi
        for ($i = 0; $i < $count; $i++) {
            Project::create([
                'name' => $faker->words(3, true), // Nome del progetto
                'description' => $faker->paragraphs(4, true), // Descrizione del progetto
                'programming_language_id' => $faker->numberBetween(1, 5), // ID del linguaggio di programmazione
                'img' => $faker->imageUrl(640, 480, 'business', true, 'Project'), // Immagine (facoltativa)
                'thumbnail_img' => $faker->imageUrl(150, 150, 'business', true, 'Thumbnail'), // Immagine miniatura (facoltativa)
                'website_url' => $faker->url, // Link al sito del progetto (facoltativo)
                'slug' => Str::slug($faker->words(3, true)), // Slug generato dal nome
            ]);
        }
    }
}
