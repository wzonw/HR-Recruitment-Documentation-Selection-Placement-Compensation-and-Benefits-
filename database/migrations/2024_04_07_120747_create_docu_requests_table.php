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
        Schema::create('docu_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('documents');
            $table->text('purpose')->nullable();
            $table->text('req_form')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docu_requests');
    }
};
