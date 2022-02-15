<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
        $birth = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $age = $this->faker->numberBetween($min = 0, $max = 100);
        $hobby = $this->faker->text($maxNbChars = 15) ;


        // $date = Carbon::parse(now())->format('Y.m.d');
        
        return [
            'name' => $name,
            'sex' => $this->faker->randomElement([Level::MASCULINE, Level::FEMININE]),
            'level_id' => Level::all()->random()->id,
            'birth' => $birth,
            'age'=> $age,
            'hobby'=> $hobby
        ];
    }
}
