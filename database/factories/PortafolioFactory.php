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
            'project_title' => fake()->name(),
            'project_description' => fake()->text(),
            'project_img' => fake()->url(),
            'project_tech' => fake()->name(),
            'project_github' => fake()->url(),
            'project_deployment' => fake()->url(),
        ];
    }
}