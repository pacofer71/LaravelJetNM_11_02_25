<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call(TagSeeder::class);
        $this->call(TypeSeeder::class);

        Storage::deleteDirectory('images/courses');
        Storage::makeDirectory('images/courses');

        $this->call(CourseSeeder::class);

      
    }
}
