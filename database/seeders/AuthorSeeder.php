<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $books=Book::all();
        Author::factory(12)->create()->each(function($author) use($books){
             $randomBooks=$books->random(rand(1,3));
             $author->books()->sync($randomBooks);
        });
    }
}
