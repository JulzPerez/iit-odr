<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_assignment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_fullname');
            $table->string('assigned_by');
            $table->string('work_status');
            $table->timestamp('completed_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_assignment');
    }
}
