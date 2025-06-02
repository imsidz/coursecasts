<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTopicGroupTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_topic_group', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_group_id')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'topic_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_topic_group');
    }
}
