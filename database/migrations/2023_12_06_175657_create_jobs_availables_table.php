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
        Schema::create('jobs_availables', function (Blueprint $table) {
            $table->id();
            $table->string('job_name'); 
            $table->string('status');
            $table->string('college');
            $table->string('dept')->nullable();
            $table->decimal('salary');
            $table->date('deadline');
            $table->text('job_desc')->nullable();
            $table->string('active', 1)->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_available');
    }
};
