<?php

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $file = $faker->image('public/uploads', 640, 480, 'cats');

            $image = Image::create(array(
                'filename' => substr($file, 6),
                'title' => $faker->sentence()
            ));
        }
    }
}