<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nik'   => '9281746329185627',
            'nama'  => 'Muhammad Zidane Iqbal',
            'telp'  => '082331046308',
            'username'  => 'zidaneiqbal',
            'password'  => bcrypt('zidaneiqbal'),
            'level' => 'admin'
        ]);
    }
}
