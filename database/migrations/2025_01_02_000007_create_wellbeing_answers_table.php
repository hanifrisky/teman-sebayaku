<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wellbeing_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konseli_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['pre_test', 'post_test']);
            $table->string('konseli_name');
            $table->enum('status', ['draft', 'completed'])->default('draft');
            $table->integer('total_score')->nullable();
            $table->foreignId('interpretation_id')->nullable()->constrained('interpretations')->nullOnDelete();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Each konseli can only have 1 pre_test and 1 post_test
            $table->unique(['konseli_id', 'type']);
        });

        Schema::create('wellbeing_answer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wellbeing_answer_id')->constrained('wellbeing_answers')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->foreignId('selected_option_id')->constrained('option_items')->cascadeOnDelete();
            $table->integer('score');
            $table->timestamps();

            $table->unique(['wellbeing_answer_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wellbeing_answer_details');
        Schema::dropIfExists('wellbeing_answers');
    }
};
