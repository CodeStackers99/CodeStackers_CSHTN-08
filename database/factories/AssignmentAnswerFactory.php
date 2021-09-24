<?php

namespace Database\Factories;

use App\Models\AssignmentAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignmentAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer_text' => $this->faker->sentence(4),
        ];
    }
}
