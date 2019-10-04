<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason');
            $table->integer('reported');
            $table->string("message")->nullable();
            $table->integer('reporter');
            $table->integer('typeOfReport')->nullable();
            $table->boolean('processed')->default(false);
            $table->unsignedBigInteger('message_id');
            $table->string('processing_reason')->nullable();
            $table->timestamps();

            $table->foreign('message_id')->references('id')->on('feeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
