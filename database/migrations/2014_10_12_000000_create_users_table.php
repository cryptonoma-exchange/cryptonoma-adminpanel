<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_no')->nullable();
            $table->integer('country')->nullable();
            $table->string('profileimg')->nullable();
            $table->text('address')->nullable();
            $table->string('twofa')->nullable();
            $table->string('google2fa_secret')->nullable();
            $table->integer('google2fa_verify')->default(0);
            $table->integer('email_verify')->nullable();
            $table->integer('kyc_verify')->default(0);
            $table->integer('profile_otp')->nullable();
            $table->integer('status')->default(0);
            $table->text('reason')->nullable();
            $table->string('verifyToken')->nullable();
            $table->integer('is_logged')->nullable();
            $table->longtext('ipaddr')->nullable();
            $table->string('device')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', ['web', 'app'])->default('web');
            $table->boolean('is_address')->default(0);
            $table->string('referral_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
