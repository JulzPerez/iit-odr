<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('odr_users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'user_type' => 'admin',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),

        ]);

        DB::table('odr_users')->insert([
            'first_name' => 'julieto',
            'last_name' => 'perez',
            'email' => 'julietoperez@gmail.com',
            'user_type' => 'requester',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),

        ]);
    }
}
