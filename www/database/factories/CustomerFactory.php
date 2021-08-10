<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->email,
            'mobile_number' => $this->faker->unique()->phoneNumber,
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'date_of_anniversary' => date('Y-m-d'),
            'address' => $this->faker->address,
            'city' => $this->faker->city
        ];
    }
}
