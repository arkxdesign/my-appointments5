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
            $table->increments('id,255');

            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->timestamp('email_verified_at',255)->nullable();
            $table->string('password',255);

            $table->string('dni',100)->nullable; //Documento Nacional de Identidad

            $table->string('address',255)->nullable;
            $table->string('phone',100)->nullable;
            $table->string('phone2',100)->nullable;

            $table->string('role',100); // 'admin', 'patient', 'doctor'

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
