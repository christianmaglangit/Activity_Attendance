<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('addactivity', function (Blueprint $table) {
            $table->id();
            $table->string('activityname');
            $table->time('TImorningStartTime');
            $table->time('TImorningEndTime');
            $table->time('TOmorningStartTime');
            $table->time('TOmorningEndTime');
            $table->time('noonStartTime');
            $table->time('noonEndTime');
            $table->time('afternoonStartTime');
            $table->time('afternoonEndTime');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addactivity');
    }
};
