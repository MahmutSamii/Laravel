<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'Mahmut Sami',
            'email'=>'samimahmut34@gmail.com',
            'password'=>bcrypt(102030)
        ]);
    }
}
