<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bank_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('bank_name',60);
            $table->string('swift_code',60);
            $table->string('account_no',60);
            $table->string('branch_street',60);
            $table->string('branch_city',60);
            $table->string('branch_zipcode',10);
            $table->string('branch_country',60);
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
        Schema::dropIfExists('user_bank_details');
    }
}
