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
        Schema::create('tm_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('task_name')->nullable();
            $table->string('user_id')->nullable();
            $table->string('assigned_user_id')->nullable();
            $table->string('system_id')->nullable();
            $table->string('care_of_user_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('task_token')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('date_created')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_tasks');
    }
};
