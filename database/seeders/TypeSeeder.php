<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $titles = ['HTML', 'JAVASCRIPT', 'CSS', 'PHP', 'SQL'];

        foreach ($titles as $title) {
            $type = new Type;
            $type->title = $title;
            $type->color = $faker->hexColor();
            $type->save();
        }

        $projects = Project::all();                       
        $type = Type::all()->pluck('id')->toArray();

        foreach($projects as $project) {
            $type_id = (random_int(0, 1) === 1) ? $faker->randomElement($type) : null;
            $project->type_id = $type_id;
            $project->save();
        }
    }
}
