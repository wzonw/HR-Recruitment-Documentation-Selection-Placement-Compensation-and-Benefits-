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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->references('id')->on('jobs_availables')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('email', 30);
            $table->text('active', 1)->default('Y');
            $table->decimal('vl_credit',8,3);
            $table->decimal('sl_credit',8,3);
            $table->decimal('cto',8,3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};