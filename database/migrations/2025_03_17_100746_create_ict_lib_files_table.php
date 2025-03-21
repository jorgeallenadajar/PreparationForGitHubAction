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
        Schema::create('ict_lib_files', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('system_id')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('ict_lib_files');
    }
};
