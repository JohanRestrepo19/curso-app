<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Book;

class AuthorFactory extends Factory
{
	protected $model = Author::class;
	public function definition()
	{
		return [
			'name' => fake()->name(),
			'biography' => fake()->paragraph(),
		];
	}

	public function configure()
	{
		return $this->afterCreating(function (Author $author) {
			Book::factory(8)->authorId($author)->create();
		});
	}
}
