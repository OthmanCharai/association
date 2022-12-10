<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Widow;

class WidowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Widow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'cnss' => $this->faker->word,
            'cin' => $this->faker->uuid(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->text,
            'priority' => $this->faker->boolean,
        ];
    }
}
