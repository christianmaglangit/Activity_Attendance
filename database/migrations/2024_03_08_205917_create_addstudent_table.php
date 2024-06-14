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
        Schema::create('addstudent', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('idnumber');
            $table->string('course');
            $table->string('yearlevel');
            $table->string('collegedep');
            $table->string('account_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addstudent');
    }
};
