<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    public function run()
    {
        $userForTags = User::where('role','<=', 1)->where('approval_status', 1)->inRandomOrder()->pluck('id')->toArray();
        $html = Tag::create([
            'name' => 'html',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $css = Tag::create([
            'name' => 'css',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $js = Tag::create([
            'name' => 'javascript',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $jquery = Tag::create([
            'name' => 'jquery',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $reactJS = Tag::create([
            'name' => 'reactjs',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $angular = Tag::create([
            'name' => 'angular',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $vue = Tag::create([
            'name' => 'vuejs',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $php = Tag::create([
            'name' => 'php',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $flask = Tag::create([
            'name' => 'flask',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $django = Tag::create([
            'name' => 'django',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $python = Tag::create([
            'name' => 'python',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $java = Tag::create([
            'name' => 'java',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $ruby = Tag::create([
            'name' => 'ruby',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $nodejs = Tag::create([
            'name' => 'nodejs',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);

        $laravel = Tag::create([
            'name' => 'laravel',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $framework = Tag::create([
            'name' => 'framework',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $frontend = Tag::create([
            'name' => 'Frontend',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $Backend = Tag::create([
            'name' => 'Backend',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $webDevelopment = Tag::create([
            'name' => 'Web Development',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
        $fullStack = Tag::create([
            'name' => 'Full Stack',
            'user_id' => $userForTags[array_rand($userForTags)],
        ]);
    }
}
