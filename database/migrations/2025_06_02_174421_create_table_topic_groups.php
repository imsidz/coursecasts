<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicTopicGroupTable extends Migration
{
    public function up(): void
    {
        Schema::create('topic_topic_group', function (Blueprint $table) {
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_group_id')->constrained()->onDelete('cascade');
            $table->primary(['topic_id', 'topic_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_topic_group');
    }
}

