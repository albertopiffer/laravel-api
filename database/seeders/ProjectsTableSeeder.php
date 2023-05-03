<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
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
        for ($i = 0; $i < 10; $i++) {

            $new_project = new Project();

            $new_project->title = $faker->sentence(3);
            $new_project->description = $faker->text(100);
            $new_project->url = $faker->url();
            $new_project->client = $faker->company();
            $new_project->slug = Str::slug($new_project->title, '-');

            $new_project->save();
        }
    }
}
