<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Usergroup;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salt = Str::random(rand(4,8));
        $usergroup = Usergroup::where('usergroup','admin')->first();

        //insert admin
        DB::table('users')->insert([
            'username'  => 'edgar99',
            'email'  => 'edgar.kirakosyan19@gmail.com',
            'password'  => md5(md5('e123456').''.$salt),
            'salt'  => $salt,
            'usergroup' => $usergroup->id,
            'email_validation'  => true,
        ]);
    }
}
