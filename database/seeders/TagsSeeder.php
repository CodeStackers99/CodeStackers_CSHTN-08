<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    public function run()
    {
        $html = Tag::create([
            'name' => 'html',
        ]);

        $css = Tag::create([
            'name' => 'css',
        ]);

        $js = Tag::create([
            'name' => 'javascript',
        ]);

        $jquery = Tag::create([
            'name' => 'jquery',
        ]);

        $reactJS = Tag::create([
            'name' => 'reactjs',
        ]);

        $angular = Tag::create([
            'name' => 'angular',
        ]);

        $vue = Tag::create([
            'name' => 'vuejs',
        ]);

        $php = Tag::create([
            'name' => 'php',
        ]);

        $flask = Tag::create([
            'name' => 'flask',
        ]);

        $django = Tag::create([
            'name' => 'django',
        ]);
        $python = Tag::create([
            'name' => 'python',
        ]);

        $java = Tag::create([
            'name' => 'java',
        ]);

        $ruby = Tag::create([
            'name' => 'ruby',
        ]);

        $nodejs = Tag::create([
            'name' => 'nodejs',
        ]);

        $laravel = Tag::create([
            'name' => 'laravel',
        ]);
        $framework = Tag::create([
            'name' => 'framework',
        ]);
        $frontend = Tag::create([
            'name' => 'Frontend',
        ]);
        $Backend = Tag::create([
            'name' => 'Backend',
        ]);
        $webDevelopment = Tag::create([
            'name' => 'Web Development',
        ]);
        $fullStack = Tag::create([
            'name' => 'Full Stack',
        ]);
    }
}
