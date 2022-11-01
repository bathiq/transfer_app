<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_transfers', function (Blueprint $table) {
            $table->id();
            $table->double('nominal_transfer');
            $table->string('bank_to');
            $table->bigInteger('bank_rekening_to');
            $table->string('name_rekening_to');
            $table->string('bank_from');
            $table->string('code_transaksi');
            $table->double('code_unix_payment');
            $table->dateTime('expired_at');
            $table->double('total_payment');
            $table->double('biaya_admin');
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
        Schema::dropIfExists('transaksi_transfers');
    }
}
