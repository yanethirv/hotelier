<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(10);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(100),
            'status' => $this->faker->randomElement([1, 2]),
            'range-rooms' => $this->faker->randomElement(['1-30', '31-51', '52-74', '75-150', '151-299', '+300']),
            'logo' => $this->faker->unique()->word(1),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,

        ];
    }
}
