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
       Schema::create('selection', function (Blueprint $table) {
            $table->increments('sel_id');
            $table->string('name', 100);
            $table->string('gender',100);
            $table->string('number',100);
            $table->date('birthday');
            $table->string('image',100);
            $table->string('zodiac',100);
            $table->string('hobby',100);
            $table->string('hometown',100);
            $table->string('height',255);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selections');
    }
};
