<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition(): array
    {
        $users = User::count();
        return [
            'name' => fake()->bothify('?????-#####'),
            'user_id' => fake()->unique()->numberBetween(1, $users),
        ];
    }
}
