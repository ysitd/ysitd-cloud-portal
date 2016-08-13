<?php

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => Uuid::NIL,
            'github_username' => 'tonyhhyip',
            'display_name' => 'Root',
            'email' => 'tony@opensource.hk',
            'root' => true
        ]);
    }
}
