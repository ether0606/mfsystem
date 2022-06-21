<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father')->nullable();
            $table->string('mobile')->nullable();
            $table->string('e_mail')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->string('profession')->nullable();
            $table->integer('donor_cat');
            $table->string('password')->nullable();
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
        Schema::dropIfExists('donors');
    }
}
