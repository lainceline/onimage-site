<?php

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $image = Image::create(array(
                'filename' => $faker->imageUrl(640, 480, 'cats'),
                'title' => $faker->sentence()
            ));
        }
    }
}