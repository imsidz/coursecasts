<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Topic;
use App\Models\Discussion;

class MigrateQuestionsToDiscussions extends Command
{
    protected $signature = 'migrate:questions-to-discussions';
    protected $description = 'Migrate data from questions table into discussions table';

    public function handle()
    {
        $this->info("Starting migration...");

        $questions = DB::table('questions')->get();
        $count = 0;

        foreach ($questions as $question) {
           

            $category = trim((string) $question->category);

            if ($category === '') {
                $this->warn("Skipping question ID {$question->id} — empty category.");
                continue;
            }
            
            $topic = Topic::firstOrCreate(
                ['title' => $category],
                ['title' => $category, 'slug' => Str::slug($category)]
            );

            // Create the discussion
            Discussion::create([
                'user_id'    => null,
                'topic_id'   => $topic->id,
                'title'      => $question->title,
                'slug'       => Str::slug($question->title) . '-' . $question->id,
                'created_at' => $question->created_at,
                'updated_at' => $question->updated_at,
            ]);

            $count++;
        }

        $this->info("Migration complete: {$count} questions migrated.");
    }
}