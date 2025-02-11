<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));
        return [
            'nombre'=>fake()->unique()->sentence(4, true),
            'descripcion'=>fake()->text(),
            'precio'=>fake()->randomFloat(2, 10, 9999),
            'fecha_inicio'=>fake()->dateTimeBetween('+1 week', '+3 week'),
            'fecha_fin'=>fake()->dateTimeBetween('+4 week', '+9 week'),
            'imagen'=>'images/courses/'.fake()->picsum('public/storage/images/courses/', 640, 480, false),
            'user_id'=>User::all()->random()->id,
            'type_id'=>Type::all()->random()->id,
            ];
    }
}
