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
        Schema::table('tm_tasks', function (Blueprint $table) {
            $table->string('taks_status')->after('remarks')->nullable();
            $table->string('task_difficult')->after('taks_status')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_tasks', function (Blueprint $table) {
            //
        });
    }
};
