<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'video' => 'videos/' . $this->faker->randomElement(['1.mp4', '2.mp4', '3.mp4']),
            'likes_count' => rand(2, 1000),
        ];
    }
}
