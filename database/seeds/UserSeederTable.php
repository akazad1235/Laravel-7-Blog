<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();
        foreach(range(1, 15) as $index){
				User::create([

		        	'name' 		=> $faker->name,
		        	'email' 	=> $faker->unique()->email,
		        	'password' 		=> bcrypt($faker->password),
		        	'image' 		=> "this is image",
		        	
		        ]);
        }
    }
}
