<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        
        return [
            'name' => $name,
            'sex' => $this->faker->randomElement([Level::MASCULINE, Level::FEMININE]),
            'level_id' => Level::all()->random()->id
        ];
    }
}
