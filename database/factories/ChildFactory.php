<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Child;
use App\Models\Sponsor;
use App\Models\Widow;

class ChildFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Child::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'gender' => $this->faker->randomElement(["Male","Female"]),
            'birth_day' => $this->faker->date(),
            'educated' => $this->faker->boolean,
            'vaccinated' => $this->faker->boolean,
            'widow_id' => Widow::factory(),
            'sponsor_id' => Sponsor::factory(),
        ];
    }
}
