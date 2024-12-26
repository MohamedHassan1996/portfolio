<?php

use App\Traits\CreatedUpdatedByMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use CreatedUpdatedByMigration;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('slug');
            $table->text('content');
            $table->json('extra_details')->nullable();
            $table->json('meta_data')->nullable();
            $table->unsignedBigInteger('career_id'); // Add event_id column
            $table->string('locale');               // Add locale column for uniqueness constraint
            $table->unique(['career_id', 'locale']);
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
            $this->CreatedUpdatedByRelationship($table);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_translations');
    }
};
