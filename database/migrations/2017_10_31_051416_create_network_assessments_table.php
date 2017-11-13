<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->date('date')->nullable();
            $table->integer('day')->nullable();
            $table->integer('hour')->nullable();
            $table->text('comment')->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('network_assessments');
    }
}
