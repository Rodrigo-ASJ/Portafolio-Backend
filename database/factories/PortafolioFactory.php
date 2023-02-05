<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portafolio>
 */
class PortafolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        //[
            'project_title' => fake()->words(rand(3,5), true),
            'project_description' => fake()->text(),
            'project_img' => fake()->image(),
            'project_tech' => fake()->name(),
            'project_github' => fake()->url(),
            'project_deployment' => fake()->url(),
        ];
    }
}
