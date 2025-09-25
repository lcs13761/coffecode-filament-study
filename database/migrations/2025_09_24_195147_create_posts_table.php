<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('featured_image')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->json('content');
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->json('meta_data')->nullable(); // SEO meta tags
            $table->integer('views_count')->default(0);
            $table->integer('reading_time')->nullable(); // em minutos
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
