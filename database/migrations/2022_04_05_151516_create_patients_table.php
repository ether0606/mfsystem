<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father');
            $table->string('father_occupation');
            $table->string('mother');
            $table->string('mother_occupation');
            $table->string('patient_occupation');
            $table->string('disease_name');
            $table->string('age');
            $table->string('disease_description')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('marital_status');
            $table->double('treatment_cost',14,2);
            $table->double('apply_amount',14,2);
            $table->string('contact');
            $table->string('alt_contact')->nullable();
            $table->string('family_member')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('nid_birthid');
            $table->string('photo')->nullable();
            $table->string('pdf_documents')->nullable();
            $table->string('id_card_font')->nullable();
            $table->string('id_card_back')->nullable();
            $table->integer('status')->default(0)->comment('0 inactive 1 active');
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
        Schema::dropIfExists('patients');
    }
}
