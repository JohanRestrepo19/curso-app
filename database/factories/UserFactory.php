<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
	protected $model = User::class;
	public function definition()
	{
		return [
			'number_id' => fake()->randomNumber(9, true),
			'name' => fake()->name(),
			'last_name' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'password' => bcrypt(123456789),
		];
	}
}
