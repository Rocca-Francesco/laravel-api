<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $titles = ['VUE', 'LARAVEL', 'VITE', 'PHP', 'HTML'];

        foreach ($titles as $title) {
            $technology = new Technology;
            $technology->title = $title;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
