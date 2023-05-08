<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;


use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $type_ids = Type::all()->pluck('id')->all();
        $technology_ids = Technology::all()->pluck('id')->all();

        for ($i = 0; $i < 20; $i++) {

            $new_project = new Project();

            $new_project->title = $faker->sentence(3);
            $new_project->description = $faker->text(100);
            $new_project->url = $faker->url();
            $new_project->client = $faker->company();
            $new_project->slug = Str::slug($new_project->title, '-');

            $new_project->type_id = $faker->optional()->randomElement($type_ids);

            $new_project->save();

            $num_technologies = rand(0, 9);
            for ($j = 0; $j < $num_technologies; $j++) {
                $random_technology_id = $faker->randomElement($technology_ids);
                $new_project->technologies()->attach($random_technology_id);
            }
        }
    }
}
