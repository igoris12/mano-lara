<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('lt_LT');

        DB::table('users')->insert([
            'name' => 'Igoris',
            'email' => 'igoris@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $mastersCount = 10;
        foreach(range(1, $mastersCount) as $_) {
            DB::table('masters')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
            ]);
        }


        $outfits = ['Dress', 'Pants', 'Coat', 'Shorts', 'Cardigan', 'Pullover', 'Overall', 'Bikini', 'Hat', 'Jeans', 'Skirt', 'Long skirt', 'Mini skirt', 'Shirts'];
        foreach(range(1, 100) as $_) {
            $type = $outfits[rand(0, count($outfits)-1)];
            DB::table('outfits')->insert([
                'type' => $type,
                'color' => $faker->colorName(),
                'size' => rand(5, 21),
                'about' => $faker->text(),
                'master_id' => rand(1, $mastersCount),
                'photo' => rand(0, 3) ? $faker->imageUrl(200, 300, $type, false) : null
            ]);
        }
    }
}
