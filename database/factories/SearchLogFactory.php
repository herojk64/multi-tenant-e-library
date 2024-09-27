<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SearchLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=>null,
            "query"=>$this->faker->paragraph(1),
            'ip_address'=>"::1",
            "searched_at"=>now()
        ];
    }
}
