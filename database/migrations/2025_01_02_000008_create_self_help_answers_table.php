<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('self_help_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konseli_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('material_question_id')->constrained('material_questions')->cascadeOnDelete();
            $table->text('answer_text');
            $table->timestamps();

            $table->unique(['konseli_id', 'material_question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('self_help_answers');
    }
};
