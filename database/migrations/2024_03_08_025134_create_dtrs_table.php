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
        Schema::create('dtrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_id')->references('id')->on('jobs_availables')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->integer('absent');
            $table->decimal('undertime');
            $table->decimal('late');
            $table->decimal('overtime');
            $table->decimal('cto');
            $table->decimal('vl_used');
            $table->decimal('sl_used');
            $table->integer('lwop');
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtrs');
    }
};
