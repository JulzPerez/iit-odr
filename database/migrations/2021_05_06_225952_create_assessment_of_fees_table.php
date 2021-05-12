<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentOfFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_of_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requests_id');
            $table->unsignedBigInteger('fees_id');
            $table->smallInteger('number_of_copy');
            $table->smallInteger('number_of_pages')->nullable();
            $table->decimal('amount',8,2);
            $table->timestamps();

            $table->foreign('requests_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('fees_id')->references('id')->on('fees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_of_fees');
    }
}
