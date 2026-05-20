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
         Schema::create('vote', function (Blueprint $table) {
            $table->increments('v_id');
            $table->unsignedInteger('sel_id');
            $table->integer('count');


            $table->foreign('sel_id')
                  ->references('sel_id')
                  ->on('selection')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
