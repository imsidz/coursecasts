<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('topic_group_topic', function (Blueprint $table) {
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_group_id')->constrained('topic_groups')->onDelete('cascade');
            $table->primary(['topic_id', 'topic_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_group_topic');
    }
};
