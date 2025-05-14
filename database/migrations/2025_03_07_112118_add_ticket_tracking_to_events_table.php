<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('capacity')->default(0); // Total tickets available
            $table->integer('tickets_sold')->default(0); // Track sold tickets
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['capacity', 'tickets_sold']);
        });
    }
};
