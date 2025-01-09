<?php

use App\Enums\Blog\BlogStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('is_published')->default(BlogStatus::NOT_PUBLISHED->value);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
