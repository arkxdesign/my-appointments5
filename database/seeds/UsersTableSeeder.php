<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    User::create([
        'name' => 'Adrian Cisneros',
        'email' => 'a_r_k_x@hotmail.com',
        'password' => bcrypt('Fantasmas_11'),
        'remember_token' => '',
        'dni' => 'CIPA781211LV1',
        'address' => 'Bruno Martinez No.4248',
        'phone' => '3311881474',
        'phone2' => '3312306627',
        'role' => 'admin'
        ]);

        User::create([
        'name' => 'Kylla Puppy',
        'email' => 'kylla@doggy.com',
        'password' => bcrypt('6627'),
        'remember_token' => '',
        'dni' => '12345679',
        'address' => 'Bruno Martinez No.4248',
        'phone' => '3311881474',
        'phone2' => '3312306627',
        'role' => 'patient'
        ]);

        User::create([
        'name' => 'Juan Pérez',
        'email' => 'juan@juan.com.mx',
        'password' => bcrypt('1474'),
        'remember_token' => '',
        'dni' => '12345679',
        'address' => 'Bruno Martinez No.4248',
        'phone' => '3311881474',
        'phone2' => '3312306627',
        'role' => 'doctor'
        ]);
        
        factory(User::class, 5)->states('patient')->create();
    }
}
