<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::create([
    		'name' => 'Võ Quốc Hải',
            'email' => 'quochainina@gmail.com',
            'password' => bcrypt('123456'),
	        'type' => 'admin',
	        'remember_token' => str_random(10),
    	]);
        // factory(App\User::class, 50)->create();
    }
}
