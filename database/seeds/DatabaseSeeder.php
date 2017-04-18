<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Models\User::create(['code'=>5555,'password'=>bcrypt(123),'email'=>'s@s.com']);
    }
}
