<?php
namespace App\Models;
use Illuminate\Database\Seeder;
use Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('users')->insert([
            'username' => 'a',
           'password' =>Hash::make(1)
        ]);
    }
}
