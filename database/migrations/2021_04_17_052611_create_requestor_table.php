<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('maiden_name')->nullable();

            $table->string('requestor_type')->nullable();
            
            $table->string('id_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('home_address')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('degree')->nullable();
            $table->string('major_option')->nullable();
            $table->string('academic_distinction')->nullable();
            $table->date('date_of_graduation')->nullable();
            $table->string('highschool_graduated')->nullable();
            $table->string('highschool_address')->nullable();
            $table->string('last_sem_attended')->nullable();
            $table->integer('last_sem_AY')->nullable();
            $table->string('last_university_attended')->nullable();
            $table->string('purpose_of_request')->nullable();

            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('spouse')->nullable();
            $table->string('name_of_father')->nullable();
            $table->string('maiden_name_of_mother')->nullable();
            $table->string('address_of_parents')->nullable();
            $table->string('authorized_person')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('odr_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestor');
    }
}
