<?php

namespace Database\Factories;

use App\Enum\ServicesType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandlordServicesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(2),
            'description'=>fake()->sentence(),
            'duration'=>fake()->randomNumber(3),
            'amount'=>random_int(1000,4000),
            'discount'=>random_int(0,80),
        ];
    }
}
