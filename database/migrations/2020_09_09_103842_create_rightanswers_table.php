<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rightanswers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->foreignId('questionier_id')->constrained()->onDelete('cascade');
            $table->string('right_answer');
            $table->string('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rightanswers');
    }
}
