<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos=Course::factory(35)->create();
        $ids=Tag::pluck('id')->toArray();
        foreach($cursos as $curso){
            shuffle($ids);
            $curso->tags()->attach($this->getRandomArrayIdTags($ids));
        }
    }
    private function getRandomArrayIdTags(array $ids):array{
       return array_slice($ids, 0, random_int(1, count($ids)-1));
    }
}
