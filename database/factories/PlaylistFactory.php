<?php



namespace Database\Factories;



use App\Models\Playlist;

use App\Models\SubCourse;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;



class PlaylistFactory extends Factory

{

    protected $model = Playlist::class;

    public function definition()

    {
        $randomImages = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(7),
            'display_image' => 'images/playlists/' . $randomImages[array_rand($randomImages)],
            'hours' => $this->faker->numberBetween(2, 50),
            'sub_course_id' => SubCourse::inRandomOrder()->first()->id,
            'user_id' => User::where('role', 0)->where('approval_status', 1)->inRandomOrder()->first()->id,
        ];

    }

}
