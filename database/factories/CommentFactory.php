<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'text' => $this->faker->realText(255),
            'note_id' => Note::all()->random()->id,
            'rate' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
