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
        Schema::table('ict_lib_files', function (Blueprint $table) {
            $table->string('orig_file_name')->after('system_id')->nullable();
            $table->string('file_name')->after('orig_file_name')->nullable();
            $table->string('year')->after('file_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ict_lib_files', function (Blueprint $table) {
            //
        });
    }
};
