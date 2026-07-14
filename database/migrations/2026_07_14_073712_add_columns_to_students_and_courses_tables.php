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
        Schema::table('students', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('title');
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['name', 'email']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
};
