<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    public function definition(){
        return [
            'title' => $this->faker->sentence(3), // Generates a random book title
            'author_name' => $this->faker->name(), // Generates a random author name
            'description' => $this->faker->paragraph(), // Generates a random description
            'published_date' => $this->faker->date(), // Generates a random published date
            'thumbnail' => $this->faker->imageUrl(640, 480, 'books', true, 'Faker'), // Generates a random thumbnail URL
            'type' => $this->faker->randomElement(['free', 'subscribed']), // Randomly selects between 'free' or 'paid'
            "file"=>"books/01J5G94XCYG7QMNH17VB15Q6CM.pdf",
            'category_id' => Category::factory(), // Associates the book with a randomly generated category
        ];
    }
}
