<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(2,5));
        return [
            'title'=> $title,
            'slug'=> Str::slug($title),
            'content'=> $this->faker->sentence(rand(2,3)),
            'premium'=> $this->faker->boolean(25)
        ];
    }
}
