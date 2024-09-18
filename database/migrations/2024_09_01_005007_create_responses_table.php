<?php

use App\Models\Question;
use App\Models\Questionnaire;
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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('userName', 650)->nullable(false);
            $table->foreignIdFor(Questionnaire::class);
            $table->foreignIdFor(Question::class);
            $table->uuid('responseGroupId')->nullable(false);
            $table->string('response', 2500)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
