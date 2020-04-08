<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            Post::create([
                "user_id"     => rand(1, 15),
                "category_id" => rand(1, 15),
                "title"       => $faker->sentence,
                "content"     => $faker->paragraph,
                "thumbnail"   => $faker->imageUrl(),
                "status"      => $this->getRandomeStatus(),
            ]);
        }

        /*Post::create([

		        	'user_id' 		=> rand(0, 20),
		        	'category_id' 	=> rand(0, 30),
		        	'title' 		=> "this is title",
		        	'content' 		=> "this is content",
		        	'thumbnail' 	=> "this is image",
		        	'status' 		=> $this->getRandomeStatus(),

		        		]);
		        		*/
    }


    public function getRandomeStatus(){
    	$status = array('draft', 'published');

    	return $status[array_rand($status)];
    }
}
