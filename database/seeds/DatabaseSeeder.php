<?php

// Abrimos nuestra consola y ejecutamos php artisan make:seeder UsersTableSeeder
// para crear nuestro seeds y poder usar la funcion.


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SpecialitiesTableSeeder::class,
            WorkDaysTableSeeder::class
        ]);
    }
}
