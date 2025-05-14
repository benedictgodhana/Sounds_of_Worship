<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('experiences', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // e.g., "Thrilling Mountain Expeditions"
        $table->string('category'); // e.g., "Adventure", "Cultural", "Relaxation"
        $table->text('description'); // e.g., "Embark on an unforgettable journey..."
        $table->string('image')->nullable(); // Path to the experience image
        $table->string('cta_text')->default('Explore'); // Call-to-action text
        $table->string('cta_link')->nullable(); // Link for the CTA
        $table->unsignedBigInteger('created_by')->nullable(); // User ID who created the experience
        $table->timestamps();

        // Foreign key constraint for created_by
        $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
