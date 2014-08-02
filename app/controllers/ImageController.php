<?php

class ImageController extends \BaseController {

    public function all()
    {
        return Image::all();
    }

    public function getPage($page) {
        Paginator::setCurrentPage($page);

        return Image::paginate(9);
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
