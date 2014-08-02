<?php

class ImageController extends \BaseController {

    public function all()
    {
        return Image::all();
    }

    public function getImages($amount) {

        if (!Session::has('counter')) {
            Session::put('counter', 0);
        }

        $counter = Session::get('counter');

        $images = Image::skip($counter * $amount)->take($amount)->get();

        Session::put('counter', ++$counter);

        return $images;
    }

    public function upload()
    {
        $file = Input::file('file');
        $destinationPath = 'uploads';
        $filename = str_random(12);
        $realFilename = $file->getClientOriginalName();

        $upload_success = Input::file('file')->move($destinationPath, $filename);

        if ($upload_success) {
            //Ok, lets put it in the database now
            $image = new Image();
            $image->filename = $filename;
            $image->title = $realFilename;
            $image->save();
            return $image;
        } else {
            return Response::json('error', 400);
        }


    }

}
