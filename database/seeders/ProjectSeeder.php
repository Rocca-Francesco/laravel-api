<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 50; $i++) { 

            $newProject = new Project;
            $newProject->title = $faker->sentence(3);
            $newProject->lenguages = $faker->sentence(3);
            $newProject->slug = Str::of($newProject->title)->slug('-');
            $newProject->link = 'https://i.pinimg.com/originals/93/9b/c7/939bc77d9e021e46690caf42521c5499.jpg';
            $newProject->save();
        }
    }
}
