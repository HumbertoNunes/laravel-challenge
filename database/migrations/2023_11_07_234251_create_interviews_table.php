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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('job_id');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('notes', 30)->nullable();
            $table->enum('status', ['waiting', 'scheduled', 'done'])->default('waiting');
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
