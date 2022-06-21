<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalvoucherbkdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journalvoucherbkdns', function (Blueprint $table) {
            $table->id();
            $table->integer('journalvoucher_id');
            $table->string('remarks')->nullable();
            $table->string('account_code');
            $table->string('table_name');
            $table->integer('table_id');
            $table->double('debit',14,2);
            $table->double('credit',14,2);
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
        Schema::dropIfExists('journalvoucherbkdns');
    }
}
