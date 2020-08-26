<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $users = [
            ['id' => 1, 'name'=> 'admin', 'email' => "fuenteamarga+square1@gmail.com", 'password' => crypt("@cces0", config('app.salt') )  ],
        ];



        DB::table('users')->truncate();
        DB::table('users')->insert($users);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
    }
}
