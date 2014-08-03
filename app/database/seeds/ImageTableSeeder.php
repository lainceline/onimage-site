<?php

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $file = $faker->image('public/uploads', 640, 480, 'cats');

            $image = Image::create(array(
                'image' => substr($file, 6),
                'thumbnail' => substr($file, 6),
                'original_filename' => substr($file, 15)
            ));
        }
    }
}