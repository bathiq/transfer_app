<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening_admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rekening_admin');
            $table->string('name_rekening_admin');
            $table->string('name_bank_admin');
            $table->string('full_name_bank_admin');
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
        Schema::dropIfExists('rekening_admins');
    }
}
