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
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable;
            $table->string('password');

            $table->string('dni')->nullable; //Documento Nacional de Identidad

            $table->string('address')->nullable;
            $table->string('phone')->nullable;
            $table->string('phone2')->nullable;

            $table->string('role')->default('patient'); // 'admin', 'patient', 'doctor'

            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB'; // !! Aquii 
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
