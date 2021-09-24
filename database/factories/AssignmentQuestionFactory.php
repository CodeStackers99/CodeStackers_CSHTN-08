<?php

namespace Database\Factories;

use App\Models\AssignmentQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignmentQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_text' => $this->faker->sentence(6) . '?',
        ];
    }
}
