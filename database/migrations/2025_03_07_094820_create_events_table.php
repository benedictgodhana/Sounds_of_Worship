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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who created the event
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('location');
            $table->boolean('is_paid')->default(false);
            $table->json('ticket_categories')->nullable(); // Stores ticket pricing tiers
            $table->string('event_image')->nullable(); // URL or path to event image
            $table->boolean('is_featured')->default(false); // Visibility flag
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
