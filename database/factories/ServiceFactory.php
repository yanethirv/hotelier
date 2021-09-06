<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(100),
            'price' => $this->faker->randomElement([19, 29, 49, 99]),
            'cost' => $this->faker->randomElement([19,29, 49, 99]),
            'type_id' => Type::all()->random()->id,
        ];
    }
}
