<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tm_task_scopes', function (Blueprint $table) {
            $table->id();
            $table->string('task_id')->nullable();
            $table->string('scope_name')->nullable();
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
        Schema::dropIfExists('tm_task_scopes');
    }
};
