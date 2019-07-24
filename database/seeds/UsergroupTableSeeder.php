<?php

use Illuminate\Database\Seeder;


class UsergroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('usergroup')->insert([
            'usergroup' => 'admin',
        ]);

        DB::table('usergroup')->insert([
            'usergroup' => 'user',
        ]);

    }
}
