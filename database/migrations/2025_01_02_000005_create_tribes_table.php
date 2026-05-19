<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tribes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Add foreign key to users table for selected_tribe_id
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('selected_tribe_id')->references('id')->on('tribes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['selected_tribe_id']);
        });
        Schema::dropIfExists('tribes');
    }
};
