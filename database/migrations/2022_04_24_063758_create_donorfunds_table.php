<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorfundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donorfunds', function (Blueprint $table) {
            $table->id();
            $table->string('jv_id');
            $table->integer('fund_type')->default(1)->comment('1 patient, 2 Medical, 3 Zakat');
            $table->integer('donor_id');
            $table->double('amount',14,2);
            $table->text('note');
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
        Schema::dropIfExists('donorfunds');
    }
}
