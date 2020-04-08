<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeederTable extends Seeder
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
            Category::create([
                "name"   => $faker->unique()->name,
                "slug"   => $this->slugify($faker->unique()->name),
                "status" => rand(0, 1),
            ]);
        }
    }

    /*public function catget(){

    	Category::create([

        	'name' => "Dells",
        	'slug' => "Dells monitor",
        	'status' => "1",
        ]);
    }
*/

    public static function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

}
