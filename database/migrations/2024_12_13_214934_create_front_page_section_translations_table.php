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
        Schema::create('front_page_section_translations', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('front_page_section_id'); // Add event_id column
            $table->string('locale');               // Add locale column for uniqueness constraint
            $table->unique(['front_page_section_id', 'locale'], 'fp_section_id_locale_unique');
            $table->foreign('front_page_section_id')->references('id')->on('front_page_sections')->onDelete('cascade');
            $this->CreatedUpdatedByRelationship($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_page_section_translations');
    }
};
