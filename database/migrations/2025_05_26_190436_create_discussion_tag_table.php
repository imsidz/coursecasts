<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('discussion_tag', function (Blueprint $table) {
            $table->foreignId('discussion_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->primary(['discussion_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussion_tag');
    }
};
