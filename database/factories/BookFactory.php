<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
            'category_id'=>Category::inRandomOrder()->first()->id,
            'publisher_id'=>Publisher::inRandomOrder()->first()->id,
            'isbn'=>fake()->isbn10(),
            'title'=>fake()->unique()->randomElement(['فن الهندسه','الاستعلام','لغات البرمجه','الاسلام ديني','اللغه الانجلزيه','الابجديه','هيا بنا','الاختصارات','التشفير','التهكير']),
            'number_of_pages'=>fake()->randomNumber(3, false),
            'number_of_copies'=>fake()->randomNumber(3, false),
             'publish_year'=>fake()->year(),
             'price'=>fake()->randomNumber(2, false),
             'cover_image'=>"images/".rand(1,6).".png",
             'description'=>fake()->realText(100)

        ];
    }
}
