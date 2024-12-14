<?php

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
        Schema::create('front_page_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->json('meta_data')->nullable();
            $table->unsignedBigInteger('front_page_id'); // Add event_id column
            $table->string('locale');               // Add locale column for uniqueness constraint
            $table->unique(['front_page_id', 'locale']);
            $table->foreign('front_page_id')->references('id')->on('front_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_page_translations');
    }
};
