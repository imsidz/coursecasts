<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JWTDiscussionSeeder extends Seeder
{
    public function run()
    {
        // Update the discussion to be visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 139],
            [
                'topic_id' => 5,
                'title' => 'JWT (JSON Web Tokens): Securing Your APIs',
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Load posts
        $posts = include database_path('data/posts_jwt_discussion.php');

        // Normalize post fields
        foreach ($posts as &$post) {
        $post['visible'] = $post['visible'] ?? false;
        $post['created_at'] = $post['created_at'] ?? now();
        $post['updated_at'] = $post['updated_at'] ?? now();
        $post['discussion_id'] = 139;
        unset($post['topic_id']); // Remove this line if topic_id doesn't exist in posts table
}
  

        // Insert posts
        DB::table('posts')->insert($posts);
    }
}