<?php

namespace Database\Factories;

use App\Models\author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "title"=>$this->faker->sentence(3),
            "isbn"=>$this->faker->isbn13(),
            "description"=>$this->faker->paragraph(),
            "author_id"=>$this->faker->randomElement([1,3,5,6,7]),
            "genre"=>$this->faker->randomElement(["fiction","novel","motivational"]),
            "published_at"=>$this->faker->date(),
            "total_copies"=>$this->faker->numberBetween(1,30),
            "available_copies"=>$this->faker->numberBetween(1,30),
            "price"=>$this->faker->randomFloat(2,50,400),
            "cover_image"=>$this->faker->imageUrl('200','300','books',true),
            "status"=>$this->faker->randomElement(["available","unavailable"]),
                    ];
    }
}
