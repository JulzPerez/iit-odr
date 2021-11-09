<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requestor_id');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('thread_id')->nullable();
            $table->smallInteger('number_of_copy')->default(1);
            $table->smallInteger('number_of_pages')->default(1);
            $table->decimal('assessment_total',8,2);
            $table->string('request_status')->default('pending');  
            $table->string('purpose_of_request');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('requestor_id')->references('id')->on('requestor')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            //$table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
