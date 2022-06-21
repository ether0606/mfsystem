<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralledgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalledgers', function (Blueprint $table) {
            $table->id();
            $table->string('journal_title');
            $table->double('dr',14,2);
            $table->double('cr',14,2);
            $table->date('v_date');
            $table->string('jv_id');
            $table->integer('masterhead_id');
            $table->integer('subhead_id');
            $table->integer('chieldheadone_id');
            $table->integer('chieldheadtwo_id');
            $table->integer('journalvoucher_id');
            $table->integer('journalvoucherbkdn_id');
            $table->integer('debitvoucher_id');
            $table->integer('debitvoucherbkdn_id');
            $table->integer('creditvoucher_id');
            $table->integer('creditvoucherbkdn_id');
            $table->integer('created_by');
            $table->integer('company_id')->default(1);
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
        Schema::dropIfExists('generalledgers');
    }
}
