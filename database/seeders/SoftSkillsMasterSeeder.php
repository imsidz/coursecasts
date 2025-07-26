<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoftSkillsMasterSeeder extends Seeder
{
    public function run()
    {
        $validUserIds = range(1, 70);

$posts = include database_path('data/posts_soft_skills_master.php');

// Filter and normalize posts
$posts = array_filter($posts, function ($post) use ($validUserIds) {
    return isset($post['user_id']) && in_array($post['user_id'], $validUserIds);
});

foreach ($posts as &$post) {
    $post['discussion_id'] = 829;
    $post['visible'] = $post['visible'] ?? false;
    $post['created_at'] = $post['created_at'] ?? now();
    $post['updated_at'] = $post['updated_at'] ?? now();
}
unset($post);

DB::table('posts')->insert($posts);
    }
}
